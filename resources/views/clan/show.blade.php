@extends('layouts.app')
@section('title', 'Клан')
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
                                                <span style="margin-top: 30px;display:flex;width: 110px;height: 110px;justify-content: center;align-items: center;" class="avatar cover-image avatar-md brround bg-violet me-3">{{substr($clan->name,0,2)}}</span>
                                            </div>
                                            <div class="profile-img-content text-dark text-start">
                                                <div class="text-dark">
                                                    <h3 class="h3 mb-2">{{$clan->name}}</h3>
                                                    <h5 class="text-muted">{{$clan->motto}}</h5>
                                                </div>
                                            </div>
                                        </div>
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


                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Участие в битве кланов</div>
                        </div>
                        <div class="card-body">
                            <div class="match-list">
                                <!-- Матч 1: Победа -->
                                @foreach($clan->mathes() as $math)
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
                                @if($clan->mathes()->count() == 0)
                                    <p class="text-muted text-center">Клан еще не участвовал в битвах</p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-6">
                    <div class="card border p-0 shadow-none">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="media mt-0">
                                    <div class="media-user me-2">
                                        <div class=""><img alt="" class="rounded-circle avatar avatar-md" src="../assets/images/users/16.jpg"></div>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mb-0 mt-1">{{$clan->name}}</h6>
                                        <small class="text-muted">Только что</small>
                                    </div>
                                </div>
                                <div class="ms-auto">
                                    <div class="dropdown show">
                                        <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                            <span class=""><i class="fe fe-more-vertical"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="javascript:void(0)">Изменить</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Удалить</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Настройки</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h4 class="fw-semibold mt-3">От школьных друзей до профессиональных команд: Роль лиги ESEA в CS2</h4>
                                <p class="mb-0">
                                    ESEA League всегда была неотъемлемой частью соревновательного Counter-Strike, вливая свежие таланты в профессиональную сцену. В последнее время она становится все более популярным вариантом для казуальных игроков, которые просто хотят выйти за рамки FACEIT-матчей. Я имею в виду, что даже я сыграл пару сезонов Лиги, и я далеко не профессиональный игрок (давайте не будем проверять статистику в моем профиле, спасибо).
                                </p>
                            </div>
                        </div>
                        <div class="card-footer user-pro-2">
                            <div class="media mt-0">
                                <div class="media-user me-2">
                                    <div class="avatar-list avatar-list-stacked">
                                        <span class="avatar brround" style="background-image: url(../assets/images/users/12.jpg)"></span>
                                        <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                        <span class="avatar brround" style="background-image: url(../assets/images/users/9.jpg)"></span>
                                        <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                        <span class="avatar brround" style="background-image: url(../assets/images/users/4.jpg)"></span>
                                        <span class="avatar brround text-primary">+28</span>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h6 class="mb-0 mt-2 ms-2">28 человек оценили запись</h6>
                                </div>
                                <div class="ms-auto">
                                    <div class="d-flex mt-1">
                                        <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-heart"></i></span></a>
                                        <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-message-square"></i></span></a>
                                        <a class="new text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-share-2"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border p-0 shadow-none">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="media mt-0">
                                    <div class="media-user me-2">
                                        <div class=""><img alt="" class="rounded-circle avatar avatar-md" src="../assets/images/users/16.jpg"></div>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mb-0 mt-1">{{$clan->name}}</h6>
                                        <small class="text-muted">Вчера, 12:40</small>
                                    </div>
                                </div>
                                <div class="ms-auto">
                                    <div class="dropdown show">
                                        <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                            <span class=""><i class="fe fe-more-vertical"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="javascript:void(0)">Изменить</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Удалить</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Настройки</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="d-flex">
                                    <a href="gallery.html" class="w-30 m-2"><img src="../assets/images/media/22.jpg" alt="img" class="br-5"></a>
                                    <a href="gallery.html" class="w-30 m-2"><img src="../assets/images//media/24.jpg" alt="img" class="br-5"></a>
                                </div>
                                <h4 class="fw-semibold mt-3">Начните свой соревновательный путь в Лиге ESEA Сезон 52</h4>
                                <p class="mb-0">
                                    Сделайте первый шаг в соревновательную командную игру и заработайте свои первые очки в региональном зачете Valve с помощью ESEA League, стартующей 8 января! Участвуйте в еженедельных официальных матчах, сбалансированных для команд вашего уровня и ориентированных на ваше расписание!
                                </p>
                            </div>
                        </div>
                        <div class="card-footer user-pro-2">
                            <div class="media mt-0">
                                <div class="media-user me-2">
                                    <div class="avatar-list avatar-list-stacked">
                                        <span class="avatar brround" style="background-image: url(../assets/images/users/12.jpg)"></span>
                                        <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                        <span class="avatar brround" style="background-image: url(../assets/images/users/9.jpg)"></span>
                                        <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                        <span class="avatar brround" style="background-image: url(../assets/images/users/4.jpg)"></span>
                                        <span class="avatar brround text-primary">+28</span>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h6 class="mb-0 mt-2 ms-2">28 человек оценили запись</h6>
                                </div>
                                <div class="ms-auto">
                                    <div class="d-flex mt-1">
                                        <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-heart"></i></span></a>
                                        <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-message-square"></i></span></a>
                                        <a class="new text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-share-2"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border p-0 shadow-none">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="media mt-0">
                                    <div class="media-user me-2">
                                        <div class=""><img alt="" class="rounded-circle avatar avatar-md" src="../assets/images/users/16.jpg"></div>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mb-0 mt-1">{{$clan->name}}</h6>
                                        <small class="text-muted">7 апреля, 09:14</small>
                                    </div>
                                </div>
                                <div class="ms-auto">
                                    <div class="dropdown show">
                                        <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                            <span class=""><i class="fe fe-more-vertical"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="javascript:void(0)">Изменить</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Удалить</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Настройки</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="d-flex">
                                    <a href="gallery.html" class="w-30 m-2"><img src="../assets/images/media/26.jpg" alt="img" class="br-5"></a>
                                    <a href="gallery.html" class="w-30 m-2"><img src="../assets/images/media/23.jpg" alt="img" class="br-5"></a>
                                    <a href="gallery.html" class="w-30 m-2"><img src="../assets/images/media/21.jpg" alt="img" class="br-5"></a>
                                </div>
                                <h4 class="fw-semibold mt-3">Thorin: «M0NESY с Falcons войдут в топ-4 BLAST Austin Major 2025»</h4>
                                <p class="mb-0">
                                    Аналитик CS2 Данкан Thorin Шилдс предположил возможные достижения Team Falcons на BLAST.tv Austin Major 2025 после слухов о переходе Ильи m0NESY Осипова в основной состав арабской команды. Он считает, что у Team Falcons есть шанс войти в топ-4.
                                </p>
                            </div>
                        </div>
                        <div class="card-footer user-pro-2">
                            <div class="media mt-0">
                                <div class="media-user me-2">
                                    <div class="avatar-list avatar-list-stacked">
                                        <span class="avatar brround" style="background-image: url(../assets/images/users/12.jpg)"></span>
                                        <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                        <span class="avatar brround" style="background-image: url(../assets/images/users/9.jpg)"></span>
                                        <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                        <span class="avatar brround" style="background-image: url(../assets/images/users/4.jpg)"></span>
                                        <span class="avatar brround text-primary">+28</span>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h6 class="mb-0 mt-2 ms-2">28 человек оценили запись</h6>
                                </div>
                                <div class="ms-auto">
                                    <div class="d-flex mt-1">
                                        <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-heart"></i></span></a>
                                        <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-message-square"></i></span></a>
                                        <a class="new text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-share-2"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
