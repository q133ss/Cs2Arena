<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClanWarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //clan1_id
        //clan2_id
        //status
        //server_ip
        //server_password
        //selected_maps
        //start_time
        //end_time
        //result
        $wars = [
            [
                'clan1_id' => 1,
                'clan2_id' => 2,
                'status' => 'pending',
                'server_ip' => '194.93.2.207:27077',
                'server_password' => 'password123',
                'selected_maps' => json_encode(['de_dust2', 'de_inferno']),
                'start_time' => now()->addDay(),
                'end_time' => now()->addDays(2),
                'result' => json_encode(['clan1_score' => 0, 'clan2_score' => 0]),
            ],
            [
                'clan1_id' => 3,
                'clan2_id' => 4,
                'status' => 'pending',
                'server_ip' => '194.93.2.207:27077',
                'server_password' => 'password123',
                'selected_maps' => json_encode(['de_dust2', 'de_inferno']),
                'start_time' => now()->addDay(),
                'end_time' => now()->addDays(2),
                'result' => json_encode(['clan1_score' => 0, 'clan2_score' => 0]),
            ],
            [
                'clan1_id' => 5,
                'clan2_id' => 6,
                'status' => 'pending',
                'server_ip' => '194.93.2.207:27077',
                'server_password' => 'password123',
                'selected_maps' => json_encode(['de_dust2', 'de_inferno']),
                'start_time' => now()->addDay(),
                'end_time' => now()->addDays(2),
                'result' => json_encode(['clan1_score' => 0, 'clan2_score' => 0]),
            ],
            [
                'clan1_id' => 7,
                'clan2_id' => 8,
                'status' => 'pending',
                'server_ip' => '194.93.2.207:27077',
                'server_password' => 'password123',
                'selected_maps' => json_encode(['de_dust2', 'de_inferno']),
                'start_time' => now()->addDay(),
                'end_time' => now()->addDays(2),
                'result' => json_encode(['clan1_score' => 0, 'clan2_score' => 0]),
            ]
        ];
    }
}
