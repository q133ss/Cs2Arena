<?php

namespace Database\Seeders;

use App\Models\Chat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chats = [
            [
                'user1_id' => 1,
                'user2_id' => 2,
            ]
        ];

        $messages = [
            [
                'chat_id' => 1,
                'user_id' => 1,
                'text' => 'Привет!!',
            ],
            [
                'chat_id' => 1,
                'user_id' => 2,
                'text' => 'Привет, как дела?',
            ],
            [
                'chat_id' => 1,
                'user_id' => 1,
                'text' => 'Все хорошо, а у тебя?'
            ]
        ];

        foreach ($chats as $chat){
            $chat = Chat::create($chat);
            foreach ($messages as $message){
                if ($message['chat_id'] == $chat->id){
                    $chat->messages()->create($message);
                }
            }
        }
    }
}
