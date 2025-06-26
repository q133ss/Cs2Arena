<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\ClanWar;
use App\Models\ClanWarServer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClanWarController extends Controller
{
    private const ACCESS_ROLES = ['leader', 'deputy'];
    public function index()
    {
        if (!auth()->check()) {
            return view('clanwar.index');
        }

        $user = auth()->user();
        $clan = $user->clan()->first();

        if (!$clan) {
            return view('clanwar.index', ['clan' => null]);
        }

        $isLeader = false;
        if (in_array($clan->pivot->role, self::ACCESS_ROLES)) {
            $isLeader = true;
        }

        $clanWars = $clan->clanwars()->orderByDesc('start_time')->get();

        $nextClanWar = $clan->clanwars()
            ->where('start_time', '>=', now())
            ->orderBy('start_time')
            ->first();

        return view('clanwar.index', [
            'clan' => $clan,
            'isLeader' => $isLeader,
            'clanWars' => $clanWars,
            'nextClanWar' => $nextClanWar,
        ]);
    }

    public function show(string $clanWarId)
    {
        $clanWar = ClanWar::findOrFail($clanWarId);
        return view('clanwar.lobby', compact('clanWar'));
    }

    // Отправить запрос на войну кланов
    public function request(Request $request, $clan_id)
    {
        $clan = Clan::findOrFail($clan_id);
        $userClan = auth()->user()->clan()->first();

        if (!in_array($userClan->pivot->role, self::ACCESS_ROLES)) {
            abort(403, 'У вас нет прав для этого действия');
        }

        if (is_string($request->selected_maps)) {
            $decodedMaps = json_decode($request->selected_maps, true);
            $request->merge(['selected_maps' => $decodedMaps]);
        }

        $validated = $request->validate([
            'selected_maps' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    $decoded = $value;
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        $fail('Некорректный JSON формат для карт.');
                    }

                    if (!is_array($decoded)) {
                        $fail('Карты должны быть массивом.');
                    }

                    if (count($decoded) < 1) {
                        $fail('Необходимо выбрать хотя бы одну карту.');
                    }
                }
            ],
            'start_time' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    if (strtotime($value) < strtotime('+1 hour')) {
                        $fail('Время начала должно быть минимум на 1 час позже текущего времени.');
                    }
                }
            ]
        ],[
            'selected_maps.required' => 'Выберите карты для войны кланов',
            'start_time.required' => 'Укажите время начала войны кланов',
            'start_time.date' => 'Некорректный формат даты и времени',
            'selected_maps.json' => 'Некорректный формат карт',
        ]);

        $validated['end_time'] = Carbon::parse($validated['start_time'])->addMinutes(90);

        $server = ClanWarServer::whereDoesntHave('clanWars', function($query) use ($validated) {
            $query->where(function($q) use ($validated) {
                $q->whereBetween('clan_wars.start_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhereBetween('clan_wars.end_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhere(function($q) use ($validated) {
                        $q->where('clan_wars.start_time', '<=', $validated['start_time'])
                            ->where('clan_wars.end_time', '>=', $validated['end_time']);
                    });
            });
        })
            ->inRandomOrder() // Берем случайный сервер из свободных
            ->first();

        if (!$server) {
            return back()->with('error', 'Нет доступных серверов в указанный период времени');
        }

        $validated['clan1_id'] = $userClan->id;
        $validated['clan2_id'] = $clan_id;
        $validated['server_id'] = $server->id ?? null;

        ClanWar::create($validated);

        return back()->with('success', 'Запрос на войну кланов отправлен');
    }

    private function cwCheck(ClanWar $clanWar)
    {
        $userClan = auth()->user()->clan()->first();

        if(($clanWar->clan1_id != $userClan->id && $clanWar->clan2_id != $userClan->id) || !in_array($userClan->pivot->role, self::ACCESS_ROLES)) {
            abort(403, 'У вас нет прав для этого действия');
        }
    }

    public function accept(string $cw_id)
    {
        $clanWar = ClanWar::findOrFail($cw_id);
        $this->cwCheck($clanWar);
        $clanWar->update(['status' => 'active']);

        return back()->with('success', 'Заявка на битву кланов принята');
    }

    public function reject(string $cw_id)
    {
        $clanWar = ClanWar::findOrFail($cw_id);
        $this->cwCheck($clanWar);
        $clanWar->delete();
        return back()->with('success', 'Заявка на битву кланов отклонена');
    }
}
