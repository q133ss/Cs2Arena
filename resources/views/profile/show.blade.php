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
                                        @if(auth()->check())
                                            @php
                                                // Проверяем статус дружбы между текущим пользователем и просматриваемым
                                                $friendshipStatus = null;

                                                // Проверяем, отправил ли текущий пользователь заявку этому пользователю
                                                $sentRequest = auth()->user()->friends('pending')
                                                    ->where('friend_id', $user->id)
                                                    ->first();

                                                // Проверяем, отправил ли этот пользователь заявку текущему
                                                $receivedRequest = $user->friends('pending')
                                                    ->where('friend_id', auth()->id())
                                                    ->first();

                                                // Проверяем, есть ли активная дружба
                                                $isFriend = auth()->user()->friends('accepted')
                                                    ->where('friend_id', $user->id)
                                                    ->exists() ||
                                                    $user->friends('accepted')
                                                    ->where('friend_id', auth()->id())
                                                    ->exists();
                                            @endphp

                                            <div class="btn-profile">
                                                @if($isFriend)
                                                    <button class="btn btn-success mt-1 mb-1" disabled>
                                                        <i class="fa fa-user-check"></i> <span>У вас в друзьях</span>
                                                    </button>
                                                @elseif($sentRequest)
                                                    <button class="btn btn-secondary mt-1 mb-1" disabled>
                                                        <i class="fa fa-clock"></i> <span>Заявка отправлена</span>
                                                    </button>
                                                @elseif($receivedRequest)
                                                    <button class="btn btn-warning mt-1 mb-1" disabled>
                                                        <i class="fa fa-user-clock"></i> <span>Заявка получена</span>
                                                    </button>
                                                @else
                                                    <form action="{{ route('friends.send.request', $user->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary mt-1 mb-1"><i class="fa fa-user-plus"></i> <span>Добавить в друзья</span></button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endif
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
                                @if($user->mathes?->isEmpty())
                                    <p class="text-center text-muted">У пользователя нет матчей</p>
                                @endif
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
                    @if($user->posts?->isEmpty()) <p class="text-center text-muted">У пользователя нет записей.</p> @endif
                    @foreach($user->posts as $post)
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
                                                <form action="{{route('post.complaint', $post->id)}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Отправить жалобу</button>
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
                                @if(!$user->friends()->limit(5)->exists())
                                        <p class="text-center text-muted">У пользователя нет друзей.</p>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Клан</div>
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
                                <p class="text-center text-muted">Пользователь не состоит в клане.</p>
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
            const response = await fetch(`/like/${postId}`, {
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
