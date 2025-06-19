@extends('layouts.app') {{-- Или ваш шаблон --}}
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        Редактировать пост
                    </div>

                    <div class="card-body">
                        {{-- Показ ошибок валидации --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Форма --}}
                        <form action="{{ route('post.update', $post) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Заголовок --}}
                            <div class="mb-3">
                                <label for="title" class="form-label">Заголовок</label>
                                <input type="text" name="title" id="title"
                                       class="form-control"
                                       value="{{ old('title', $post->title) }}" required>
                            </div>

                            {{-- Текст --}}
                            <div class="mb-3">
                                <label for="text" class="form-label">Текст</label>
                                <textarea name="text" id="text" rows="5"
                                          class="form-control" required>{{ old('text', $post->text) }}</textarea>
                            </div>

                            {{-- Кнопки --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('profile.index') }}" class="btn btn-secondary">Назад</a>
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
