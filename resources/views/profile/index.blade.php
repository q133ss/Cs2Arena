@extends('layouts.app')
@section('title', 'Профиль')
@section('content')
    <div class="row" id="user-profile">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="wideget-user mb-2">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="panel profile-cover">
                                        <div class="profile-cover__action bg-img" style="background-image: url('/assets/images/cs2-bg.png'); background-position: center"></div>
                                        <div class="profile-cover__img">
                                            <div class="profile-img-1">
{{--                                                <img src="../assets/images/users/21.jpg" alt="img">--}}
                                                <span style="margin-top: 30px;display:flex;width: 110px;height: 110px;justify-content: center;align-items: center;" class="avatar cover-image avatar-md brround bg-violet me-3">{{substr($user->username,0,2)}}</span>
                                            </div>
                                            <div class="profile-img-content text-dark text-start">
                                                <div class="text-dark">
                                                    <h3 class="h3 mb-2">{{$user->username}}</h3>
                                                    <h5 class="text-muted">{{$user->steam_id}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="">
                                        <div class="social social-profile-buttons mt-5 float-end">
                                            <div class="mt-3">
                                                <a class="social-icon text-primary" href="https://steamcommunity.com/id/{{$user->steam_id}}" target="_blank"><i class="fa fa-steam"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="main-profile-contact-list">
                                <div class="me-5">
                                    <div class="media mb-4 d-flex">
                                        <div class="media-icon bg-secondary bradius me-3 mt-1">
                                            <i class="fe fe-award fs-20 text-white"></i>
                                        </div>
                                        <div class="media-body">
                                            <span class="text-muted">Mix-ранг</span>
                                            <div class="fw-semibold fs-25">
                                                {{$user->rank_mix}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="me-5 mt-5 mt-md-0">
                                    <div class="media mb-4 d-flex">
                                        <div class="media-icon bg-primary bradius text-white me-3 mt-1">
                                                                <span class="mt-3">
                                                                    <i class="fe fe-shield fs-20"></i>
                                                                </span>
                                        </div>
                                        <div class="media-body">
                                            <span class="text-muted">CW-ранг</span>
                                            <div class="fw-semibold fs-25">
                                                {{$user->rank_cw}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="me-5 mt-5 mt-md-0">
                                    <div class="media mb-4 d-flex">
                                        <div class="media-icon bg-secondary bradius text-white me-3 mt-1">
                                                                <span class="mt-3">
                                                                    <i class="fe fe-award    fs-20"></i>
                                                                </span>
                                        </div>
                                        <div class="media-body">
                                            <span class="text-muted">Побед в CW</span>
                                            <div class="fw-semibold fs-25">
                                                {{$user->cw_wins}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="me-5 mt-5 mt-md-0">
                                    <div class="media mb-4 d-flex">
                                        <div class="media-icon bg-primary bradius text-white me-3 mt-1">
                                                                <span class="mt-3">
                                                                    <i class="fe fe-thumbs-up fs-20"></i>
                                                                </span>
                                        </div>
                                        <div class="media-body">
                                            <span class="text-muted">Побед в mix</span>
                                            <div class="fw-semibold fs-25">
                                                {{$user->mix_wins}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="me-0 mt-5 mt-md-0">
                                    <div class="media">
                                        <div class="media-icon bg-secondary text-white bradius me-3 mt-1">
                                                                <span class="mt-3">
                                                                    <i class="fe fe-list fs-20"></i>
                                                                </span>
                                        </div>
                                        <div class="media-body">
                                            <span class="text-muted">Всего матчей</span>
                                            <div class="fw-semibold fs-25">
                                                {{$user->total_matches}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Последние матчи</div>
                        </div>
                        <div class="card-body">
                            <div class="match-list">
                                <!-- Матч 1: Победа -->
                                @foreach($user->mathes as $math)
                                    @php
                                        $result = $math->result['total'];
                                        if($result == 'win'){
                                            $class = 'bg-success';
                                            $badge = 'Победа';
                                        } elseif($result == 'lose'){
                                            $class = 'bg-danger';
                                            $badge = 'Поражение';
                                        } else {
                                            $class = 'bg-warning';
                                            $badge = 'Выход';
                                        }
                                    @endphp
                                <div class="match-item {{$class}} bg-opacity-10 p-3 mb-3 rounded-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{$math->map}}</h6>
                                            <p class="mb-0"><strong>Сервер:</strong> {{$math->server?->ip}}</p>
                                            <p class="mb-0"><strong>Счёт:</strong> {{$math->result['user1']['frags']}}:{{$math->result['user1']['deaths']}}</p>
                                        </div>
                                        <div>
                                            <span class="badge {{$class}}">{{$badge}}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <form class="profile-edit" method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="text" class="form-control mb-3 @error('title') is-invalid @enderror"" placeholder="Заголовок поста" value="{{old('title')}}" name="title">
                                @error('title')
                                <div class="invalid-feedback mb-3">{{ $message }}</div>
                                @enderror
                                <textarea class="form-control @error('text') is-invalid @enderror" placeholder="Напишите что-нибудь..." rows="7" name="text"></textarea>
                                @error('text')
                                <div class="invalid-feedback mb-3">{{ $message }}</div>
                                @enderror
                                <div class="profile-share border-top-0">
                                    <div class="mt-2">
                                        <a href="javascript:void(0)" id="upload-trigger" class="me-2" title="Изображение" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <span class="text-muted"><i class="fe fe-image"></i></span>
                                        </a>
                                        <input type="file" id="image-upload" name="images[]" multiple accept="image/*" style="display: none;">
                                    </div>
                                    <button class="btn btn-sm btn-success ms-auto"><i class="fa fa-share ms-1"></i> Отправить</button>
                                </div>
                                <div id="image-preview" class="d-flex flex-wrap gap-2 mb-3"></div>
                            </form>
                        </div>
                    </div>

                    @foreach($user->posts as $post)
                    <div class="card border p-0 shadow-none">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="media mt-0">
                                    <div class="media-user me-2">
                                        <div class=""><img alt="" class="rounded-circle avatar avatar-md" src="../assets/images/users/16.jpg"></div>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mb-0 mt-1">{{$user->username}}</h6>
                                        <small class="text-muted">
                                            @php
                                                $date = \Carbon\Carbon::parse($post->created_at);
                                            @endphp

                                            @if($date->isYesterday())
                                                Вчера, {{ $date->format('H:i') }}
                                            @elseif($date->isToday())
                                                Сегодня, {{ $date->format('H:i') }}
                                            @else
                                                {{ $date->format('d.m.Y H:i') }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                <div class="ms-auto">
                                    <div class="dropdown show">
                                        <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                            <span class=""><i class="fe fe-more-vertical"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{route('post.edit', $post->id)}}">Изменить</a>
                                            <form action="{{route('post.destroy', $post->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">Удалить</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                @if($post->files)
                                <div class="d-flex">
                                    @foreach($post->files as $file)
                                    <a href="#" class="w-30 m-2"><img src="{{$file->src}}" alt="img" class="br-5"></a>
                                    @endforeach
                                </div>
                                @endif
                                <h4 class="fw-semibold mt-3">{{$post->title}}</h4>
                                <p class="mb-0">
                                    {!! $post->text !!}
                                </p>
                            </div>
                        </div>
                        <div class="card-footer user-pro-2">
                            <div class="media mt-0">
                                @if(!$post->likes->isEmpty())
                                <div class="media-user me-2">
                                    <div class="avatar-list avatar-list-stacked">
                                        @foreach($post->likes?->take(5) as $like)
                                        <span class="avatar brround" style="background-image: url('{{$like->user?->avatar_url}}')"></span>
                                        @endforeach
                                        @if($post->likes->count() > 5)
                                            <span class="avatar brround text-primary">+{{$post->likes?->count() - 5}}</span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                <div class="media-body">
                                    <h6 class="mb-0 mt-2 ms-2">{{$post->likes?->count() ?? 0}} человек оценили запись</h6>
                                </div>
                                <div class="ms-auto">
                                    <div class="d-flex mt-1">
                                        @php
                                            $liked = auth()->check() && $post->likes->contains('user_id', auth()->id());
                                        @endphp
                                        <a class="new me-2 {{ $liked ? 'text-danger' : 'text-muted' }} fs-16" href="JavaScript:void(0);">
                                            <span class=""><i class="fe fe-heart"></i></span>
                                        </a>

{{--                                        <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-message-square"></i></span></a>--}}
                                        <a class="new text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-share-2"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Друзья</div>
                        </div>
                        <div class="card-body">
                            <div class="">
                                @foreach($user->friends()->limit(5)->get() as $friend)
                                    @if($loop->first)
                                        <div class="media overflow-visible">
                                            <span class="avatar cover-image avatar-md brround bg-violet me-3">{{substr($friend->username,0,2)}}</span>
                                            <div class="media-body valign-middle mt-2">
                                                <a href="" class="fw-semibold text-dark">
                                                    {{ strlen($friend->username) > 15 ? substr($friend->username, 0, 15) . '...' : $friend->username }}
                                                </a>
                                                <p class="text-muted mb-0">
                                                    {{ strlen($friend->clan?->first()?->name) > 12 ? substr($friend->clan?->first()?->name, 0, 12) . '...' : $friend->clan?->first()?->name }}
                                                </p>
                                            </div>
                                            <div class="media-body valign-middle text-end overflow-visible mt-2">
                                                <a class="btn btn-sm btn-secondary" href="{{route('profile.show', $friend->id)}}">Профиль</a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="media overflow-visible mt-sm-5">
                                            <span class="avatar cover-image avatar-md brround bg-violet me-3">{{substr($friend->username,0,2)}}</span>
                                            <div class="media-body valign-middle mt-2">
                                                <a href="" class="fw-semibold text-dark">{{ strlen($friend->username) > 15 ? substr($friend->username, 0, 15) . '...' : $friend->username }}</a>
                                                <p class="text-muted mb-0">{{ strlen($friend->clan?->first()?->name) > 12 ? substr($friend->clan?->first()?->name, 0, 12) . '...' : $friend->clan?->first()?->name }}</p>
                                            </div>
                                            <div class="media-body valign-middle text-end overflow-visible mt-1">
                                                <a class="btn btn-sm btn-secondary" href="{{route('profile.show', $friend->id)}}">Профиль</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Мой клан</div>
                        </div>
                        <div class="card-body">
                            @if($user->clan?->first())
                                <div class="media overflow-visible">
                                    <!-- Логотип клана -->
{{--                                    <img class="avatar brround avatar-md me-3"--}}
{{--                                         src="{{ $user->clan?->first()?->logo ?? '../assets/images/users/18.jpg' }}"--}}
{{--                                         alt="Clan Logo">--}}

                                    <span class="avatar cover-image avatar-md brround bg-violet me-3">{{substr($user->clan?->first()->name,0,2)}}</span>

                                    <!-- Информация о клане -->
                                    <div class="media-body valign-middle mt-2">
                                        <h5 class="fw-semibold text-dark">
                                            {{ strlen($user->clan?->first()?->name) > 15 ? substr($user->clan?->first()?->name, 0, 15) . '...' : $user->clan?->first()?->name }}
                                        </h5>
                                        <p class="text-muted mb-0">
                                            Рейтинг: <strong>{{ $user->clan?->first()?->points }}</strong>
                                        </p>
                                        <p class="text-muted mb-0">
                                            Дивизион: <strong>{{ $user->clan?->first()?->division }}</strong>
                                        </p>
                                    </div>

                                    <!-- Кнопки -->
                                    <div class="media-body valign-middle text-end overflow-visible mt-2">
                                        <a class="btn btn-sm btn-primary mb-1" href="{{ route('clan.members', $user->clan?->first()?->id) }}">
                                            Список участников
                                        </a>
                                        <a class="btn btn-sm btn-secondary" href="{{ route('clan.show', $user->clan?->first()?->id) }}">
                                            На страницу клана
                                        </a>
                                    </div>
                                </div>
                            @else
                                <p class="text-center text-muted">Вы не состоите в клане.</p>

                                <div class="d-flex gap-2">
                                    <a href="{{route('clan.list')}}" class="btn w-100 btn-secondary">Найти клан</a>
                                    <a href="{{route('clans.create')}}" class="btn w-100 btn-secondary">Создать клан</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL-END -->
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const uploadInput = document.getElementById('image-upload');
            const previewContainer = document.getElementById('image-preview');
            const uploadTrigger = document.getElementById('upload-trigger');

            // Проверка что элементы существуют
            if (!uploadInput || !previewContainer || !uploadTrigger) {
                console.error('Не найдены необходимые элементы DOM');
                return;
            }

            // Обработчик клика по триггеру
            uploadTrigger.addEventListener('click', function() {
                uploadInput.click();
            });

            // Обработчик выбора файлов
            uploadInput.addEventListener('change', function(event) {
                console.log('Файлы выбраны', event.target.files);
                previewContainer.innerHTML = '';

                if (!event.target.files.length) return;

                Array.from(event.target.files).forEach((file, index) => {
                    if (!file.type.match('image.*')) {
                        console.log('Пропущен файл (не изображение):', file.name);
                        return;
                    }

                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const previewDiv = document.createElement('div');
                        previewDiv.className = 'position-relative';
                        previewDiv.style.width = '100px';
                        previewDiv.style.height = '100px';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-thumbnail h-100 w-100 object-fit-cover';

                        const removeBtn = document.createElement('button');
                        removeBtn.innerHTML = '×';
                        removeBtn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
                        removeBtn.style.transform = 'translate(30%, -30%)';
                        removeBtn.onclick = function() {
                            removeImage(index);
                            previewDiv.remove();
                        };

                        previewDiv.appendChild(img);
                        previewDiv.appendChild(removeBtn);
                        previewContainer.appendChild(previewDiv);
                    };

                    reader.readAsDataURL(file);
                });
            });

            // Функция удаления файла из input
            function removeImage(index) {
                const files = Array.from(uploadInput.files);
                files.splice(index, 1);

                const dataTransfer = new DataTransfer();
                files.forEach(file => dataTransfer.items.add(file));
                uploadInput.files = dataTransfer.files;

                console.log('Файл удален, осталось:', uploadInput.files.length);
            }
        });
    </script>
@endsection
