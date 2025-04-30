<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public function index()
    {
        //
    }

    public function store(string $user_id, string $message)
    {
        Notification::create([
            'user_id' => $user_id,
            'message' => $message
        ]);

        return true;
    }
}
