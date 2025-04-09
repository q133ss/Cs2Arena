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

                                <a href="{{route('clan.show', $clan->id)}}" class="btn btn-primary">На страницу клана</a>

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

                        <div class="card-header">
                            <div class="card-title">Список участников</div>
                        </div>
                        <div class="card-body">
                            <div class="">
                                @foreach($members as $participant)
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
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- COL-END -->
    </div>
@endsection
