<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendShipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $friendships = [
            [
                'user_id' => 1,
                'friend_id' => 2,
            ],
            [
                'user_id' => 1,
                'friend_id' => 3,
            ],
            [
                'user_id' => 1,
                'friend_id' => 4,
            ],
            [
                'user_id' => 1,
                'friend_id' => 5,
            ],
            [
                'user_id' => 1,
                'friend_id' => 6
            ],
        ];

        $statuses = [
            '0' => 'pending',
            '1' => 'accepted',
            '2' => 'rejected'
        ];

        foreach ($friendships as $friendship) {
            DB::table('friendships')->insert([
                'user_id' => $friendship['user_id'],
                'friend_id' => $friendship['friend_id'],
                'status' => $statuses[rand(0,2)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
