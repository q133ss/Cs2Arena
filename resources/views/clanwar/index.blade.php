@extends('layouts.app')
@section('title', 'Битва кланов')
@section('content')
    @if(!auth()->check())
        <div class="alert alert-primary mt-5" role="alert">
            Войдите в систему, чтобы участвовать в битве кланов.
        </div>
    @else
        <div class="container mt-5">
            <h1 class="text-center mb-4">Главная страница битвы кланов</h1>

            {{-- Ближайшая битва --}}
            <div class="mb-4">
                <h4>Ближайшая битва</h4>
                @if($nextClanWar)
                    <div class="card">
                        <div class="card-body">
                            <p><strong>Дата:</strong> {{ $nextClanWar->start_time }}</p>
                            <p><strong>Статус:</strong> {{ $nextClanWar->status }}</p>
                            <p><strong>Карты:</strong> {{ $nextClanWar->selected_maps }}</p>
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
                                {{ $war->start_time }} —
                                vs {{ $war->clan1_id === $clan->id ? 'Клан #' . $war->clan2_id : 'Клан #' . $war->clan1_id }} —
                                Статус: {{ $war->status }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endif
@endsection
