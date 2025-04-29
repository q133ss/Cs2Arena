<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClanController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $clans = Clan::query()
            ->where('minimal_rating', '<', $user->rank_cw)
            ->withCount('members')
            ->when($user, function($query) use ($user) {
                $query->with(['applications' => function($q) use ($user) {
                    $q->where('user_id', $user->id)
                        ->select(['id', 'user_id', 'clan_id', 'status']); // Оптимизация - выбираем только нужные поля
                }]);
            })
            ->orderBy('points', 'DESC')
            ->paginate();

        // Добавляем флаги статусов заявок
        if ($user) {
            $clans->getCollection()->transform(function($clan) {
                $clan->application_status = $clan->applications->first()?->status;
                return $clan;
            });
        }

        $hasClan = $user->clan->first() ? true : false;

        return view('clan.list', compact('clans', 'hasClan'));
    }

    public function ratings()
    {
        $clans = Clan::orderBy('points', 'DESC')->get();
        return view('clan.ratings', compact('clans'));
    }

    public function members(Clan $clan)
    {
        return view('clan.members', [
            'clan' => $clan,
            'members' => $clan->members
        ]);
    }

    public function show(Clan $clan)
    {
        return view('clan.show', compact('clan'));
    }

    public function create()
    {
        return view('clan.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Проверяем, не состоит ли пользователь уже в клане
        if ($user->clan?->first()) {
            return redirect()->back()->with('error', 'Вы уже состоите в клане');
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:32',
                'unique:clans',
            ],
            'description' => [
                'nullable',
                'string',
                'max:255',
            ],
            'motto' => [
                'nullable',
                'string',
                'max:64',
            ],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpeg,png',
                'max:2048',
            ],
            'minimal_rating' => [
                'required',
                'integer',
                'min:0',
                'max:'.$user->rank_cw,
            ],
        ], [
            'name.required' => 'Поле "Название клана" обязательно для заполнения',
            'name.string' => 'Название клана должно быть строкой',
            'name.max' => 'Название клана не должно превышать 32 символа',
            'name.unique' => 'Клан с таким названием уже существует',

            'description.string' => 'Описание должно быть строкой',
            'description.max' => 'Описание не должно превышать 255 символов',

            'motto.string' => 'Девиз должен быть строкой',
            'motto.max' => 'Девиз не должен превышать 64 символа',

            'avatar.image' => 'Файл должен быть изображением',
            'avatar.mimes' => 'Изображение должно быть в формате JPEG или PNG',
            'avatar.max' => 'Размер изображения не должен превышать 2MB',

            'minimal_rating.required' => 'Укажите минимальный рейтинг для вступления',
            'minimal_rating.integer' => 'Рейтинг должен быть целым числом',
            'minimal_rating.min' => 'Рейтинг не может быть отрицательным',
            'minimal_rating.max' => 'Минимальный рейтинг не может превышать ваш текущий рейтинг ('.$user->rank_cw.')',
        ]);

        // Обработка загрузки аватара
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('clan-avatars', 'public');
        }

        DB::beginTransaction();
        try {
            // Создание клана
            $clan = Clan::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'motto' => $validated['motto'],
                'avatar_url' => '/storage/' . $avatarPath,
                'leader_id' => $user->id,
                'minimal_rating' => $validated['minimal_rating'],
                'points' => 0,
            ]);

            DB::table('clan_members')->insert([
                'user_id' => $user->id,
                'clan_id' => $clan->id,
                'role' => 'leader',
            ]);

            DB::commit();
            return redirect()->route('clan.show', $clan)->with('success', 'Клан успешно создан!');
        }catch (\Exception $exception){
            DB::rollBack();
            \Log::error('Ошибка при создании клана: '.$exception->getMessage());
            return redirect()->back()->with('error', 'Ошибка при создании клана, попробуйте позже');
        }
    }
}
