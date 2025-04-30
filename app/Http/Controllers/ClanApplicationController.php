<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\ClanApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClanApplicationController extends Controller
{
    public function apply(Clan $clan, Request $request)
    {
        $user = auth()->user();

        // Проверки
        if ($user->clan_id) {
            return response()->json([
                'success' => false,
                'message' => 'Вы уже состоите в клане'
            ], 422);
        }

        if ($clan->applications()->where('user_id', $user->id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Вы уже подавали заявку в этот клан'
            ], 422);
        }

        if ($clan->minimal_rating && $user->rank_cw < $clan->minimal_rating) {
            return response()->json([
                'success' => false,
                'message' => 'Ваш рейтинг слишком низкий для вступления в этот клан'
            ], 422);
        }

        // Создание заявки
        $application = $clan->applications()->create([
            'user_id' => $user->id,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Заявка успешно отправлена! Ожидайте решения лидера клана'
        ]);
    }

    public function processApplication(string $applicationId, string $action)
    {
        $application = ClanApplication::findOrFail($applicationId);

        $role = DB::table('clan_members')->where('clan_id', $application->clan_id)
            ->where('user_id', auth()->id())
            ->select('role')
            ->first();

        // Роли, которым разрешено принимать заявки
        $accessRoles = ['leader', 'deputy'];
        if (!$role || !in_array($role->role, $accessRoles)) {
            return response()->json([
                'message' => 'У вас нет прав для принятия заявок'
            ], 403);
        }

        DB::beginTransaction();
        try{
            if ($action === 'accept') {
                $application->status = 'approved';
                $application->save();

                DB::table('clan_members')->insert([
                    'user_id' => $application->user_id,
                    'clan_id' => $application->clan_id,
                    'role' => 'member',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                DB::commit();
                return response()->json([
                    'message' => 'Игрок успешно принят в клан'
                ]);
            } else {
                $application->status = 'rejected';
                $application->save();
                DB::commit();
                return response()->json([
                    'message' => 'Заявка отклонена'
                ]);
            }
        }catch (\Exception $exception){
            DB::rollBack();
            \Log::error($exception->getMessage());
            return response()->json([
                'message' => 'Ошибка при обработке заявки, попробуйте позже'
            ], 500);
        }
    }

    public function allApplications(string $id)
    {
        $clan = Clan::findOrFail($id);

        $accessRoles = ['leader', 'deputy'];
        $userClan = auth()->user()->clan()?->first();

        if($userClan->id == $clan->id && in_array($userClan->pivot?->role, $accessRoles)){
            $applications = $clan->applications()->with('user')->get();
            return view('clan.applications', compact('applications', 'userClan'));
        }else{
            abort(403);
        }
    }

    public function delete(string $id)
    {
        $application = ClanApplication::findOrFail($id);
        $accessRoles = ['leader', 'deputy'];
        $userClan = auth()->user()->clan()?->first();
        if($userClan->id == $application->clan_id && in_array($userClan->pivot?->role, $accessRoles)){
            $application->delete();
            return response()->json([
                'message' => 'Заявка удалена'
            ]);
        }
        abort(403);
    }
}
