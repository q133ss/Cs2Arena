@extends('layouts.app')
@section('title', 'Рейтинг кланов')
@section('content')
    <h1 class="mt-5">Рейтинг кланов</h1>
    <p class="h4">
        Список кланов по рейтингу
    </p>

    <table class="table border text-nowrap text-md-nowrap table-bordered mb-0">
        <thead>
        <tr>
            <th>#</th>
            <th>Клан</th>
            <th>Рейтинг</th>
            <th>Дивизион</th>
            <th>Кол-во побед в CW</th>
            <th>Кол-во участников</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clans as $index => $clan)
        <tr>
            <td>{{$index + 1}}</td>
            <td><a href="{{route('clan.show', $clan->id)}}">{{$clan->name}}</a></td>
            <td>{{$clan->points}}</td>
            <td>{{$clan->division}}</td>
            <td>{{$clan->winsCount()}}</td>
            <td>{{$clan->members()?->count()}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
