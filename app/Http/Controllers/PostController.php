<?php

namespace App\Http\Controllers;

use App\Models\File;
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
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
}
