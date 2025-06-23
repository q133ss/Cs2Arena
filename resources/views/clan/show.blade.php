@extends('layouts.app')
@section('title', 'Клан')
@section('meta')
    <style>
        .map-selector {
            position: relative;
            cursor: pointer;
            transition: all 0.3s;
        }

        .map-selector:hover {
            transform: scale(1.05);
        }

        .map-selector img {
            border: 3px solid transparent;
            transition: all 0.3s;
        }

        input[type="checkbox"]:checked + .map-selector img {
            border-color: #ffc107;
            box-shadow: 0 0 10px rgba(255, 193, 7, 0.5);
        }

        .map-name {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px;
            text-align: center;
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
    @php
        $accessRoles = ['leader', 'deputy'];
        $userClan = auth()->user()?->clan()?->first() ?? null;
    @endphp
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
                                                <span style="margin-top: 30px;display:flex;width: 110px;height: 110px;justify-content: center;align-items: center;" class="avatar cover-image avatar-md brround bg-violet me-3">{{substr($clan->name,0,2)}}</span>
                                            </div>
                                            <div class="profile-img-content text-dark text-start">
                                                <div class="text-dark">
                                                    <h3 class="h3 mb-2">{{$clan->name}}</h3>
                                                    <h5 class="text-muted">{{$clan->motto}}</h5>
                                                </div>
                                            </div>
                                        </div>

                                        @if($userClan?->id == $clan->id)
                                        <div class="btn-profile">
                                            <form action="{{ route('leave.clan', $clan->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger mt-1 mb-1"><i class="fa fa-sign-out"></i> <span>Выйти из клана</span></button>
                                            </form>
                                        </div>
                                        @elseif($userClan?->id && $userClan?->pivot?->role == 'leader')
                                            <div class="btn-profile">
                                                @if(\App\Models\ClanWar::where('clan1_id', $userClan->id)
                                                        ->orWhere('clan2_id', $userClan->id)
                                                        ->where('status', '!=', 'completed')
                                                        ->exists())
                                                    <button disabled class="btn btn-primary">Запрос на битву отправлен</button>
                                                @else
                                                    <!-- Кнопка для открытия модального окна -->
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#clanWarModal">
                                                        <i class="fa fa-fire"></i> Пригласить на битву кланов
                                                    </button>

                                                    <!-- Модальное окно -->
                                                    <div class="modal fade" id="clanWarModal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Приглашение на битву кланов</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form id="clanWarForm" action="{{ route('cw.request', $clan->id) }}" method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <!-- Выбор карт -->
                                                                        <div class="mb-4">
                                                                            <h6>Выберите карты:</h6>
                                                                            <div class="row maps-container">
                                                                                @foreach(['dust2', 'inferno', 'mirage', 'overpass', 'nuke', 'vertigo', 'ancient'] as $map)
                                                                                    <div class="col-md-3 col-6 mb-3">
                                                                                        <input type="checkbox" name="selected_maps[]" id="map_{{ $map }}" value="{{ $map }}" class="d-none">
                                                                                        <label for="map_{{ $map }}" class="map-selector">
                                                                                            <img src="{{ asset('images/maps/'.$map.'.webp') }}" alt="{{ $map }}" class="img-fluid">
                                                                                            <div class="map-name">{{ ucfirst($map) }}</div>
                                                                                        </label>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>

                                                                        <!-- Выбор даты и времени -->
                                                                        <div class="mb-3">
                                                                            <label for="war_datetime" class="form-label">Дата и время начала битвы</label>
                                                                            <input type="datetime-local"
                                                                                   class="form-control"
                                                                                   id="war_datetime"
                                                                                   name="start_time"
                                                                                   min="{{ now()->addHour()->format('Y-m-d\TH:i') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                                                        <button type="submit" class="btn btn-primary">Отправить</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="">
                                        <div class="social social-profile-buttons mt-5 float-end">
                                            <div class="mt-3">
                                                <a class="social-icon text-primary" href="https://steamcommunity.com/id/" target="_blank"><i class="fa fa-steam"></i></a>
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
                                            <span class="text-muted">Ранг</span>
                                            <div class="fw-semibold fs-25">
                                                {{$clan->points}}
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
                                            <span class="text-muted">Дивизион</span>
                                            <div class="fw-semibold fs-25">
                                                {{$clan->division}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($userClan?->id == $clan->id && in_array($userClan->pivot?->role, $accessRoles))
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Заявки на вступление в клан</div>
                        </div>
                        <div class="card-body">
                            <div class="match-list">
                                <!-- Матч 1: Победа -->
                                @foreach($clan->applications()->with('user')->where('status', 'pending')->get() as $application)
                                    <div class="card">
                                        <div class="d-flex align-items-center">

                                            <div class="card-body">
                                                <a class="fw-bold" href="{{route('profile.show', $application->user?->id)}}">{{$application->user?->username}}</a>
                                                <br>
                                                <span class="badge bg-primary me-2">CW: </span>{{$application->user?->rank_cw}}
                                                <span class="badge bg-primary me-2">MIX: </span>{{$application->user?->rank_mix}}
                                            </div>

                                            <div class="w-100" role="group" aria-label="Действия с заявкой">
                                                <button type="button" class="w-100 btn btn-secondary accept-application" data-application-id="{{ $application->id }}">Принять</button>
                                                <button type="button" class="w-100 mt-1 btn btn-warning reject-application" data-application-id="{{ $application->id }}">Отклонить</button>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                                @if($clan->applications()->where('status', 'pending')->count() == 0)
                                    <p class="text-muted text-center">Новых заявок еще нет</p>
                                    <div class="w-100 text-center">
                                        <a href="{{route('clan.applications.all', $clan->id)}}" class="text-center">Все заявки</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

{{--                        Заявки на битву--}}
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Заявки на битву кланов</div>
                            </div>
                            <div class="card-body">
                                <div class="match-list">
                                    <!-- Матч 1: Победа -->
                                    @if($clan->mathes()->where('status', 'pending')->isEmpty())
                                        <p class="text-muted text-center">Заявок нет</p>
                                    @endif
                                    @foreach($clan->mathes()->where('status', 'pending') as $math)
                                        <div class="match-item bg-opacity-10 p-3 mb-3 rounded-3">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">

                                                    @php
                                                        if($math->clan1_id == $clan->id){
                                                            $aponent = $math->clan2;
                                                        } else {
                                                            $aponent = $math->clan1;
                                                        }
                                                    @endphp
                                                    <p class="mb-0"><strong>Клан:</strong> <a href="{{route('clan.show', $aponent->id)}}">{{$aponent->name}}</a></p>

                                                    <p class="mb-1">Карты:
                                                        @foreach($math->selected_maps as $map)
                                                            <span class="badge bg-secondary me-1">{{$map}}</span>
                                                        @endforeach
                                                    </p>

                                                    <p>Дата начала: {{$math->start_time?->format('d.m.Y H:i')}}</p>

{{--                                                    TODO нужно понять, вдруг это мы отправили запрос--}}
                                                    <button class="btn btn-success">Принять</button>
                                                    <button class="btn btn-secondary">Отклонить</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Участие в битве кланов</div>
                        </div>
                        <div class="card-body">
                            <div class="match-list">
                                <!-- Матч 1: Победа -->
                                @if($clan->mathes()->where('status', '!=', 'pending')->isEmpty())
                                    <p class="text-muted text-center">Клан еще не участвовал в битвах</p>
                                @endif
                                @foreach($clan->mathes()->where('status', '!=', 'pending') as $math)
                                    @php
                                        $result = isset($math->result['total']) ? $math->result['total'] : null;
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
                                                @php
                                                    if($math->clan1_id == $clan->id){
                                                        $aponent = $math->clan2;
                                                    } else {
                                                        $aponent = $math->clan1;
                                                    }
                                                @endphp
                                                <p class="mb-0"><strong>Клан:</strong> <a href="{{route('clan.show', $aponent->id)}}">{{$aponent->name}}</a></p>

                                                <p class="mb-0"><strong>Сервер:</strong> {{$math->server?->name}}</p>

                                                <p class="mb-0"><strong>Счёт:</strong>
                                                    @if($result)
                                                    {{$math->result['user1']['frags']}}:{{$math->result['user1']['deaths']}}
                                                    @else
                                                        Матч еще не состоялся, либо был отменен
                                                    @endif
                                                </p>

                                                <p>Дата начала: {{$math->start_time?->format('d.m.Y H:i')}}</p>
                                            </div>
                                            @if($result)
                                            <div>
                                                <span class="badge {{$class}}">{{$badge}}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-6">
                    @if($userClan?->id == $clan->id && in_array($userClan?->pivot?->role, $accessRoles))
                    <div class="card">
                        <div class="card-body">
                            <form class="profile-edit" method="POST" action="{{route('post.clan.store', $clan->id)}}" enctype="multipart/form-data">
                                @csrf
                                <input type="text" class="form-control mb-3 @error('title') is-invalid @enderror" placeholder="Заголовок поста" value="{{old('title')}}" name="title">
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
                    @endif
                    @if($clan->posts->isEmpty()) <p class="text-center text-muted">У клана нет записей.</p> @endif
                    @foreach($clan->posts as $post)
                        <div class="card border p-0 shadow-none">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="media mt-0">
                                        <div class="media-user me-2">
                                            <div class="">
                                                <span class="avatar cover-image avatar-md brround bg-violet me-3">{{substr($post->user?->username,0,2)}}</span>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0 mt-1">{{$post->user?->username}}</h6>
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
                                    @if($userClan?->id == $clan->id && in_array($userClan?->pivot?->role, $accessRoles))
                                    <div class="ms-auto">
                                        <div class="dropdown show">
                                            <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                                <span class=""><i class="fe fe-more-vertical"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{route('post.clan.edit', $post->id)}}">Изменить</a>
                                                <form action="{{route('post.clan.delete', $post->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">Удалить</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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
                                        <h6 class="mb-0 mt-2 ms-2" id="like-count-{{ $post->id }}">
                                            {{ $post->likes->count() }} {{ trans_choice('человек|человека|человек', $post->likes->count()) }} {{$post->likes->count() == 1 ? 'оценил' : 'оценили'}} запись
                                        </h6>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="d-flex mt-1">
                                            @php
                                                $liked = auth()->check() && $post->likes->contains('user_id', auth()->id());
                                            @endphp
                                            <a onclick="likePost({{ $post->id }})"
                                               class="new me-2 {{ $liked ? 'text-danger' : 'text-muted' }} fs-16"
                                               href="javascript:void(0);"
                                               id="like-btn-{{ $post->id }}">
                                                <i class="fe fe-heart"></i>
                                            </a>
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
                            <div class="card-title">Участники</div>
                        </div>
                        <div class="card-body">
                            <div class="">
                                @foreach($clan->members()->limit(5)->get() as $participant)
                                    @if($loop->first)
                                        <div class="media overflow-visible">
                                            <span class="avatar cover-image avatar-md brround bg-violet me-3">{{substr($participant->username,0,2)}}</span>
                                            <div class="media-body valign-middle mt-2">
                                                <a href="" class="fw-semibold text-dark">
                                                    {{ strlen($participant->username) > 15 ? substr($participant->username, 0, 15) . '...' : $participant->username }}
                                                </a>
                                                <p class="text-muted mb-0">
                                                    {{ strlen($participant->clan?->first()?->name) > 12 ? substr($participant->clan?->first()?->name, 0, 12) . '...' : $participant->clan?->first()?->name }}
                                                </p>
                                            </div>
                                            <div class="media-body valign-middle text-end overflow-visible mt-2">
                                                <a class="btn btn-sm btn-secondary" href="{{route('profile.show', $participant->id)}}">Профиль</a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="media overflow-visible mt-sm-5">
                                            <span class="avatar cover-image avatar-md brround bg-violet me-3">{{substr($participant->username,0,2)}}</span>
                                            <div class="media-body valign-middle mt-2">
                                                <a href="" class="fw-semibold text-dark">{{ strlen($participant->username) > 15 ? substr($participant->username, 0, 15) . '...' : $participant->username }}</a>
                                                <p class="text-muted mb-0">{{ strlen($participant->clan?->first()?->name) > 12 ? substr($participant->clan?->first()?->name, 0, 12) . '...' : $participant->clan?->first()?->name }}</p>
                                            </div>
                                            <div class="media-body valign-middle text-end overflow-visible mt-1">
                                                <a class="btn btn-sm btn-secondary" href="{{route('profile.show', $participant->id)}}">Профиль</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <a href="{{route('clan.members',$clan->id)}}" class="btn btn-primary mt-5">Все участники</a>
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
        document.querySelectorAll('.accept-application').forEach(btn => {
            btn.addEventListener('click', function() {
                const applicationId = this.getAttribute('data-application-id');
                processApplication(applicationId, 'accept');
            });
        });

        document.querySelectorAll('.reject-application').forEach(btn => {
            btn.addEventListener('click', function() {
                const applicationId = this.getAttribute('data-application-id');
                processApplication(applicationId, 'reject');
            });
        });

        function processApplication(applicationId, action) {
            const btn = event.currentTarget;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

            axios.post(`/clan/applications/${applicationId}/${action}`)
                .then(response => {
                    showToast('success', response.data.message);
                    btn.closest('.card').remove();
                })
                .catch(error => {
                    btn.disabled = false;
                    btn.innerHTML = action === 'accept'
                        ? 'Принять'
                        : 'Отклонить';

                    showToast('error', error.response?.data?.message || 'Ошибка обработки заявки');
                });
        }
    </script>

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
            }
        });

        function getRussianPlural(number, words) {
            // Проверяем, что массив words содержит 3 элемента
            if (words.length !== 3) {
                return words[0] || '';
            }

            const lastTwo = Math.abs(number) % 100;
            const lastDigit = lastTwo % 10;

            if (lastTwo > 10 && lastTwo < 20) {
                return words[2];
            }
            if (lastDigit === 1) {
                return words[0];
            }
            if (lastDigit >= 2 && lastDigit <= 4) {
                return words[1];
            }
            return words[2];
        }

        async function likePost(postId) {
            try {
                const response = await fetch(`/clan/like/${postId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin'
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Ошибка при обработке лайка');
                }

                // Обновляем кнопку лайка
                const likeBtn = document.getElementById(`like-btn-${postId}`);
                likeBtn.classList.toggle('text-danger');
                likeBtn.classList.toggle('text-muted');

                // Обновляем счетчик лайков
                const likeCount = document.getElementById(`like-count-${postId}`);
                likeCount.textContent = `${data.likesCount} ${getRussianPlural(data.likesCount, ['человек', 'человека', 'человек'])} ${data.likesCount == 1 ? 'оценил' : 'оценили'} запись`;

                // Обновляем аватары (если нужно)
                // updateLikesAvatars(postId, data);

            } catch (error) {
                console.error('Error:', error);
                if (error.message.includes('Unauthenticated')) {
                    window.location.href = '{{ route("login") }}';
                } else {
                    console.error('Error:', error);
                }
            }
        }
    </script>
@endsection
