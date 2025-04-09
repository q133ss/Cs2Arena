<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];

    public function formattedTime(): ?string
    {
        $now = now();
        $notification = $this;
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

    public function formattedDate()
    {
        $notification = $this;
        if($notification->created_at?->isToday()){
            return 'Сегодня';
        }elseif ($notification->created_at?->isYesterday()){
            return 'Вчера';
        }else{
            return $notification->created_at?->translatedFormat('j F');
        }
    }
}
