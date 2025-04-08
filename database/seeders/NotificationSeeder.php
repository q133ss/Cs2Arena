<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notifications = [
            [
                'user_id' => 1,
                'type' => 'info',
                'message' => 'Добро пожаловать на платформу!',
                'is_read' => false,
            ],
            [
                'user_id' => 1,
                'type' => 'info',
                'message' => 'У вас 3 непрочитанных сообщения',
                'is_read' => false,
            ],
            [
                'user_id' => 1,
                'type' => 'info',
                'message' => 'Новая заявка в друзья!',
                'is_read' => false,
            ]
        ];

        foreach($notifications as $notification) {
            Notification::create($notification);
        }
    }
}
