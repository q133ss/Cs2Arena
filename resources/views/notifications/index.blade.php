@extends('layouts.app')
@section('title', 'Уведомления')
@section('content')
    <ul class="notification">
        @foreach($notifications as $notification)
        <li>
            <div class="notification-time">
                <span class="date">
                    {{$notification->formattedDate()}}
                </span>
                <span class="time">{{ $notification->created_at?->format('H:i') }}</span>
            </div>
            <div class="notification-icon">
                <a href="javascript:void(0);"></a>
            </div>
            <div class="notification-time-date mb-2 d-block d-md-none">
                <span class="date">{{$notification->formattedDate()}}</span>
                <span class="time ms-2">{{ $notification->created_at?->format('H:i') }}</span>
            </div>
            <div class="notification-body">
                <div class="media mt-0">
                    <div class="main-avatar avatar-md online">
                        <img alt="avatar" class="br-7" src="../assets/images/users/1.jpg">
                    </div>
                    <div class="media-body ms-3 d-flex">
                        <div class="">
                            <p class="fs-15 text-dark fw-bold mb-0">
                                Новое уведомление!
                            </p>
                            <p class="mb-0 fs-13 text-dark">{{$notification->message}}</p>
                        </div>
                        <div class="notify-time">
                            <p class="mb-0 text-muted fs-11">{{$notification->formattedTime()}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        @endforeach
        <li class="d-grid justify-content-center">
            {{ $notifications->links() }}
        </li>
    </ul>
@endsection
