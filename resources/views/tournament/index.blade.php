@extends('layouts.app')
@section('title', 'Заголовок')
@section('content')
    <h1 class="text-center mb-4">Турниры CS2</h1>
    @foreach($tournaments as $tournament)
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mb-4">
                <img src="/assets/images/tournament.jpg" class="card-img-top" alt="Логотип турнира">
                <div class="card-body">
                    <h5 class="card-title">{{$tournament->name}}</h5>
                    <p class="card-text">{{$tournament->description}}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Начало турнира:</strong> {{\Carbon\Carbon::parse($tournament->tournament_start_time)->format('d.m.Y H:i')}}</li>
                        <li class="list-group-item"><strong>Окончание регистрации:</strong> {{\Carbon\Carbon::parse($tournament->end_registration_time)?->format('d.m.Y H:i')}}</li>
                        <li class="list-group-item"><strong>Количество команд:</strong> {{$tournament->size}}</li>
                        <li class="list-group-item"><strong>Доступные дивизионы:</strong>
                        @foreach($tournament->accepted_divisions as $division)
                            <span class="badge bg-primary">{{$division}}</span>
                        @endforeach
                        </li>
                        <li class="list-group-item"><strong>Статус:</strong> {{$statuses[$tournament->status]}}</li>
                    </ul>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-primary" type="button">Отправить заявку на участие</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection
