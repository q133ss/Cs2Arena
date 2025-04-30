<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\ClanApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClanApplicationController extends Controller
{
    private const ACCESS_ROLES = ['leader', 'deputy'];

    /**
     * Подать заявку на вступление в клан
     */
    public function apply(Clan $clan, Request $request)
    {
        $user = auth()->user();

        $this->validateApplication($user, $clan);

        ClanApplication::create([
            'user_id' => $user->id,
            'clan_id' => $clan->id,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Заявка успешно отправлена! Ожидайте решения лидера клана'
        ]);
    }

    /**
     * Обработать заявку (принять/отклонить)
     */
    public function processApplication(string $application_id, string $action)
    {
        $application = ClanApplication::findOrFail($application_id);
        $this->authorizeApplicationProcessing($application);

        DB::transaction(function () use ($application, $action) {
            if ($action === 'accept') {
                $this->acceptApplication($application);
            } else {
                $this->rejectApplication($application);
            }
        });

        return response()->json([
            'message' => $action === 'accept'
                ? 'Игрок успешно принят в клан'
                : 'Заявка отклонена'
        ]);
    }

    /**
     * Просмотр всех заявок клана
     */
    public function allApplications(string $id)
    {
        $clan = Clan::findOrFail($id);
        $this->authorizeViewApplications($clan);

        $applications = $clan->applications()->with('user')->get();
        $userClan = auth()->user()->clan()->first();

        return view('clan.applications', compact('applications', 'userClan'));
    }

    /**
     * Удалить заявку
     */
    public function destroy(string $id)
    {
        $application = ClanApplication::findOrFail($id);
        $this->authorizeApplicationProcessing($application);

        $application->delete();

        return response()->json(['message' => 'Заявка удалена']);
    }

    /**
     * Валидация заявки перед созданием
     */
    private function validateApplication($user, $clan): void
    {
        if ($user->clan()->first()) {
            abort(422, 'Вы уже состоите в клане');
        }

        if ($clan->applications()->where('user_id', $user->id)->exists()) {
            abort(422, 'Вы уже подавали заявку в этот клан');
        }

        if ($clan->minimal_rating && $user->rank_cw < $clan->minimal_rating) {
            abort(422, 'Ваш рейтинг слишком низкий для вступления в этот клан');
        }
    }

    /**
     * Авторизация обработки заявки
     */
    private function authorizeApplicationProcessing(ClanApplication $application): void
    {
        $userClan = auth()->user()->clan()->first();

        if (!$userClan ||
            $userClan->id !== $application->clan_id ||
            !in_array($userClan->pivot->role, self::ACCESS_ROLES)) {
            abort(403, 'У вас нет прав для этого действия');
        }
    }

    /**
     * Авторизация просмотра заявок
     */
    private function authorizeViewApplications(Clan $clan): void
    {
        $userClan = auth()->user()->clan()->first();

        if (!$userClan ||
            $userClan->id !== $clan->id ||
            !in_array($userClan->pivot->role, self::ACCESS_ROLES)) {
            abort(403);
        }
    }

    /**
     * Принять заявку
     */
    private function acceptApplication(ClanApplication $application): void
    {
        $application->update(['status' => 'approved']);

        DB::table('clan_members')->insert([
            'user_id' => $application->user_id,
            'clan_id' => $application->clan_id,
            'role' => 'member',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Отклонить заявку
     */
    private function rejectApplication(ClanApplication $application): void
    {
        $application->update(['status' => 'rejected']);
    }
}
