@extends('layouts.app')
@section('title', 'Битва кланов')
@section('content')
    @if(!auth()->check())
        <div class="alert alert-primary mt-5" role="alert">
            Войдите в систему, чтобы участвовать в битве кланов.
        </div>
    @else
        @php
            $getStatus = [
                'pending' => 'Ожидание',
                'active'  => 'Заявка принята',
                'completed' => 'Завершен',
                'disputed' => 'Спорная ситуация'
            ];
        @endphp
        <div class="container mt-5">
            <h1 class="text-center mb-4">Главная страница битвы кланов</h1>

            {{-- Ближайшая битва --}}
            <div class="mb-4">
                <h4>Ближайшая битва</h4>
                @if($nextClanWar)
                    <div class="card">
                        <div class="card-body">
                            <p><strong>Дата:</strong> {{ $nextClanWar->start_time }}</p>
                            <p><strong>Статус:</strong> {{ $getStatus[$nextClanWar->status] }}</p>
                            <p><strong>Карта:</strong> {{ $nextClanWar->selected_maps[0] }}</p>
                            <a href="{{route('cw.show', $nextClanWar->id)}}" class="btn btn-primary">Перейти в лобби</a>
                        </div>
                    </div>
                @else
                    <p>Ближайших битв пока нет.</p>
                @endif
            </div>

            {{-- История битв --}}
            <div class="mb-4">
                <h4>История битв</h4>
                @if($clanWars->isEmpty())
                    @if($isLeader)
                        <div class="alert alert-info">
                            Вы не провели ещё ни одной битвы кланов. Чтобы пригласить клан на битву,
                            перейдите на детальную страницу клана и нажмите кнопку
                            <strong>"Отправить приглашение на битву кланов"</strong>.
                        </div>
                        <a href="{{ route('clan.ratings') }}" class="btn btn-primary">К списку кланов</a>
                    @else
                        <p>Ваш клан ещё не участвовал в битвах.</p>
                    @endif
                @else
                    <ul class="list-group">
                        @foreach($clanWars as $war)
                            <li class="list-group-item">
                                {{ $war->start_time->format('d.m.Y H:i') }} —
                                против <a href="{{route('clan.show',  $war->clan1_id === $clan->id ? $war->clan2_id : $war->clan1_id)}}">{{ $war->clan1_id === $clan->id ? 'Клан #' . $war->clan2_id : 'Клан #' . $war->clan1_id }}</a> —
                                Статус: {{ $getStatus[$war->status] }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endif
@endsection
