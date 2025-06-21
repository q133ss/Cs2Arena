@extends('layouts.app')
@section('title', 'Заявки в друзья')
@section('content')
    <div class="row" id="user-profile">
            <div class="row mt-5">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Заявки в друзья</h3>
                            <div class="card-options">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#incoming">
                                            <i class="fa fa-clock-o me-2"></i>Входящие ({{ $incomingRequests->count() }})
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#outgoing">
                                            <i class="fa fa-paper-plane me-2"></i>Исходящие ({{ $outgoingRequests->count() }})
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Входящие заявки -->
                                <div class="tab-pane active" id="incoming">
                                    @if($incomingRequests->isEmpty())
                                        <p class="text-center text-muted">Нет входящих заявок</p>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{route('profile.index')}}" class="btn btn-primary">Вернуться в профиль</a>
                                        </div>
                                    @else
                                        <div class="list-group">
                                            @foreach($incomingRequests as $request)
                                                <div class="list-group-item">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <span class="avatar cover-image avatar-md brround bg-violet me-3">{{substr($request->user->username,0,2)}}</span>
                                                        </div>
                                                        <div class="col">
                                                            <h4 class="mb-1">{{ $request->user->username }}</h4>
                                                            <small class="text-muted">Отправлено {{ $request->created_at->diffForHumans() }}</small>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="btn-group">
                                                                <form action="{{ route('friends.accept.request', $request) }}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-success">
                                                                        <i class="fa fa-check"></i> Принять
                                                                    </button>
                                                                </form>
                                                                <form action="{{ route('friends.reject.request', $request) }}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                                        <i class="fa fa-times"></i> Отклонить
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- Исходящие заявки -->
                                <div class="tab-pane" id="outgoing">
                                    @if($outgoingRequests->isEmpty())
                                        <p class="text-center text-muted">Нет исходящих заявок</p>
                                    @else
                                        <div class="list-group">
                                            @foreach($outgoingRequests as $request)
                                                <div class="list-group-item">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <span class="avatar cover-image avatar-md brround bg-violet me-3">{{substr($request->friend->username,0,2)}}</span>
                                                        </div>
                                                        <div class="col">
                                                            <h4 class="mb-1">{{ $request->friend->username }}</h4>
                                                            <small class="text-muted">Отправлено {{ $request->created_at->diffForHumans() }}</small>
                                                        </div>
                                                        <div class="col-auto">
                                                            <form action="{{ route('friends.remove.friend', $request) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-secondary">
                                                                    <i class="fas fa-trash-alt"></i> Отменить
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Активация табов
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = new bootstrap.Tab(document.querySelector('.nav-tabs a.nav-link'));
        });
    </script>
@endsection
