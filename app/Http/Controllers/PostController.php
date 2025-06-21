<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\ClanPost;
use App\Models\Complaint;
use App\Models\File;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private function authorize(Post $post)
    {
        if($post->user_id !== Auth::id()) {
            abort(403, 'У вас нет прав для выполнения этого действия.');
        }
    }

    private function authorizeClan(ClanPost $post)
    {
        $userClan = Auth::user()->clan?->first();
        $role = $userClan->pivot?->role;
        $accessRoles = ['leader', 'deputy'];

        if($post->clan_id !== $userClan->id || !in_array($role, $accessRoles)) {
            abort(403, 'У вас нет прав для выполнения этого действия.');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function like(Post $post)
    {
        try {
            $like = Like::where([
                'user_id' => Auth::id(),
                'likeable_type' => Post::class,
                'likeable_id' => $post->id,
            ])->exists();

            if($like) {
                Like::where([
                    'user_id' => Auth::id(),
                    'likeable_type' => Post::class,
                    'likeable_id' => $post->id,
                ])->delete();
            }else{
                Like::create([
                    'user_id' => Auth::id(),
                    'likeable_type' => Post::class,
                    'likeable_id' => $post->id,
                ]);
            }

            $likeCount = Like::where('likeable_type', Post::class)->where('likeable_id', $post->id)->count();

            return response()->json(['success' => true, 'likesCount' => $likeCount]);
        }catch (\Exception $exception){
            // Логируем ошибку, если нужно
            \Log::error('Ошибка при лайке поста: ' . $exception->getMessage());
            return response()->json(['success' => false, 'message' => 'Произошла ошибка при обработке запроса.'], 500);
        }
    }

    public function clanLike(ClanPost $post)
    {
        try {
            $like = Like::where([
                'user_id' => Auth::id(),
                'likeable_type' => ClanPost::class,
                'likeable_id' => $post->id,
            ])->exists();

            if($like) {
                Like::where([
                    'user_id' => Auth::id(),
                    'likeable_type' => ClanPost::class,
                    'likeable_id' => $post->id,
                ])->delete();
            }else{
                Like::create([
                    'user_id' => Auth::id(),
                    'likeable_type' => ClanPost::class,
                    'likeable_id' => $post->id,
                ]);
            }

            $likeCount = Like::where('likeable_type', ClanPost::class)->where('likeable_id', $post->id)->count();

            return response()->json(['success' => true, 'likesCount' => $likeCount]);
        }catch (\Exception $exception){
            // Логируем ошибку, если нужно
            \Log::error('Ошибка при лайке поста: ' . $exception->getMessage());
            return response()->json(['success' => false, 'message' => 'Произошла ошибка при обработке запроса.'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string|max:65535',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Максимальный размер 2MB
        ],[
            'title.required' => 'Поле "Заголовок" обязательно для заполнения.',
            'text.required' => 'Поле "Текст" обязательно для заполнения.',
            'title.max' => 'Максимальная длина заголовка - 255 символов.',
            'text.max' => 'Максимальная длина текста - 65535 символов.',
            'images.*.image' => 'Каждый файл должен быть изображением.',
            'images.*.mimes' => 'Допустимые форматы изображений: jpeg, png, jpg, gif, svg.',
            'images.*.max' => 'Максимальный размер изображения - 2MB.'
        ]);

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'text' => $validated['text'],
        ]);

        if($request->images){
            foreach ($request->images as $image) {
                File::create([
                    'fileable_type' => Post::class,
                    'fileable_id' => $post->id,
                    'src' => '/storage/' . $image->store('posts', 'public'),
                    'category' => 'file'
                ]);
            }
        }

        return redirect()->route('profile.index')->with('success', 'Запись успешно создана!');
    }

    public function storeClan(Request $request, $clan_id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string|max:65535',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Максимальный размер 2MB
        ],[
            'title.required' => 'Поле "Заголовок" обязательно для заполнения.',
            'text.required' => 'Поле "Текст" обязательно для заполнения.',
            'title.max' => 'Максимальная длина заголовка - 255 символов.',
            'text.max' => 'Максимальная длина текста - 65535 символов.',
            'images.*.image' => 'Каждый файл должен быть изображением.',
            'images.*.mimes' => 'Допустимые форматы изображений: jpeg, png, jpg, gif, svg.',
            'images.*.max' => 'Максимальный размер изображения - 2MB.'
        ]);

        $post = ClanPost::create([
            'clan_id' => $clan_id,
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'text' => $validated['text'],
        ]);

        if($request->images){
            foreach ($request->images as $image) {
                File::create([
                    'fileable_type' => Post::class,
                    'fileable_id' => $post->id,
                    'src' => '/storage/' . $image->store('posts', 'public'),
                    'category' => 'file'
                ]);
            }
        }

        return back()->with('success', 'Запись успешно создана!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Можно проверить, принадлежит ли пост текущему пользователю
        $this->authorize($post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize($post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('profile.index', $post)->with('success', 'Запись успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize($post);
        $post->delete();

        return redirect()->route('profile.index')->with('success', 'Запись успешно удалена!');
    }

    public function complaint(Post $post)
    {
        Complaint::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ]);

        return back()->with('success', 'Жалоба отправлена!');
    }

    public function editClanPost($post_id){
        $post = ClanPost::findOrFail($post_id);
        $this->authorizeClan($post);

        return view('posts.clan.edit', compact('post'));
    }

    public function updateClanPost(Request $request, $post_id)
    {
        $post = ClanPost::findOrFail($post_id);
        $this->authorizeClan($post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        $post->update($validated);

        return to_route('clan.show', $post->clan_id)->with('success', 'Запись успешно обновлена!');
    }

    public function deleteClanPost($post_id){
        $post = ClanPost::findOrFail($post_id);
        $this->authorizeClan($post);
        $post->delete();
        return back()->with('success', 'Запись успешно удалена!');
    }
}
