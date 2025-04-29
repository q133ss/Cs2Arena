@extends('layouts.app')
@section('title', 'Создать клан')
@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Создание нового клана</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('clans.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Название клана</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}" required maxlength="32">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Максимум 32 символа</small>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Описание клана</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="3" maxlength="255">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Максимум 255 символов</small>
                            </div>

                            <div class="mb-3">
                                <label for="motto" class="form-label">Девиз клана</label>
                                <input type="text" class="form-control @error('motto') is-invalid @enderror"
                                       id="motto" name="motto" value="{{ old('motto') }}" maxlength="64">
                                @error('motto')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Краткий слоган вашего клана</small>
                            </div>

                            <div class="mb-3">
                                <label for="avatar" class="form-label">Аватар клана</label>
                                <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                       id="avatar" name="avatar" accept="image/png, image/jpeg">
                                @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Рекомендуемый размер: 256x256px</small>
                            </div>

                            <div class="mb-3">
                                <label for="minimal_rating" class="form-label">Минимальный рейтинг для вступления</label>
                                <input type="number" class="form-control @error('minimal_rating') is-invalid @enderror"
                                       id="minimal_rating" name="minimal_rating"
                                       value="{{ old('minimal_rating', 0) }}" min="0" max="{{ auth()->user()->rank_cw }}" required>
                                @error('minimal_rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    Ваш текущий рейтинг: {{ auth()->user()->rank_cw }}.
                                </small>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Создать клан
                                </button>
                                <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary">
                                    Отмена
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Динамическое обновление максимального значения рейтинга
            const ratingInput = document.getElementById('minimal_rating');
            const userRating = {{ auth()->user()->rank_cw }};

            ratingInput.addEventListener('input', function() {
                if (parseInt(this.value) > userRating) {
                    this.value = userRating;
                }
            });
        });
    </script>
@endsection
