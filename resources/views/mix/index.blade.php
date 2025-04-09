@extends('layouts.app')
@section('title', 'Микс')
@section('content')
    <h1 class="text-center mb-4">Список серверов CS2</h1>
    <!-- Список серверов -->
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="list-group">
                @foreach($servers as $server)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Название сервера: {{$server['name']}}</h5>
                        <p class="mb-1"><strong>IP:</strong> {{$server['ip_address']}}</p>
                        @if($server['server_info'] != null)
                            <p class="mb-1"><strong>Карта:</strong> {{$server['server_info']['map']}}</p>
                            <p class="mb-1"><strong>Игроки:</strong> {{$server['server_info']['players']}}/{{$server['server_info']['max_players']}}</p>
                        @else
                            <p class="mb-1"><strong>Карта:</strong>Не удалось загрузить</p>
                            <p class="mb-1"><strong>Игроки:</strong>Не удалось загрузить</p>
                        @endif
                        <p class="mb-1"><strong>Пинг:</strong> 777 ms</p>
                    </div>
                    <button class="btn btn-success" type="button">Подключиться</button>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Статистика игрока -->
    <div class="row mt-5">
        <div class="col-md-8 offset-md-2">
            <h2 class="text-center mb-4">Ваша статистика</h2>
            <div class="card">
                <div class="card-body">
                    @if(auth()->check())
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Уровень:</strong> 15</li>
                        <li class="list-group-item"><strong>Количество матчей:</strong> 120</li>
                        <li class="list-group-item"><strong>Процент побед:</strong> 65%</li>
                        <li class="list-group-item"><strong>Процент попаданий в голову:</strong> 12.3%</li>
                        <li class="list-group-item"><strong>Среднее количество смертей за матч:</strong> 12.3</li>
                        <li class="list-group-item"><strong>Среднее количество смертей за матч:</strong> 12.3</li>
                    </ul>
                    @else
                        <p class="text-muted">Войдите в систему, что увидеть свою статистику</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
