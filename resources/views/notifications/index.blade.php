@extends('layouts.app')
@section('title', 'Уведомления')
@section('content')
    @php
    function formattedDate($notification): ?string
    {
        if($notification->created_at?->isToday()){
            return 'Сегодня';
        }elseif ($notification->created_at?->isYesterday()){
            return 'Вчера';
        }else{
            return $notification->created_at?->translatedFormat('j F');
        }
    }

    function formattedTime($notification): ?string
    {
        $now = now();
        $diffInHours = $notification->created_at?->diffInHours($now);

        if ($notification->created_at?->isToday()) {
            if ($diffInHours < 1) {
                return $notification->created_at?->diffForHumans(['parts' => 1]); // "25 минут назад"
            } elseif ($diffInHours < 24) {
                return $notification->created_at?->diffForHumans(['parts' => 1, 'short' => false]); // "2 часа назад"
            } else {
                return $notification->created_at?->format('H:i'); // "14:30"
            }
        } else {
            return $notification->created_at?->format('H:i'); // Для вчерашних и старых - только время
        }
    }
    @endphp

    <ul class="notification">
        @foreach($notifications as $notification)
        <li>
            <div class="notification-time">
                <span class="date">
                    {{formattedDate($notification)}}
                </span>
                <span class="time">{{ $notification->created_at?->format('H:i') }}</span>
            </div>
            <div class="notification-icon">
                <a href="javascript:void(0);"></a>
            </div>
            <div class="notification-time-date mb-2 d-block d-md-none">
                <span class="date">{{formattedDate($notification)}}</span>
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
                            <p class="mb-0 text-muted fs-11">{{formattedTime($notification)}}</p>
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
