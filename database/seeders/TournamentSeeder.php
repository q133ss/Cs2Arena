<?php

namespace Database\Seeders;

use App\Models\Tournament;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tournaments = [
            [
                'name' => 'Турнир 1',
                'description' => 'Описание турнира 1',
                'start_time' => now()->addDays(1),
                'end_registration_time' => now()->addDays(2),
                'tournament_start_time' => now()->addDays(3),
                'size' => 8,
                'accepted_divisions' => json_encode(['A', 'B']),
                'status' => 'pending'
            ],
            [
                'name' => 'Турнир 2',
                'description' => 'Описание турнира 2',
                'start_time' => now()->addDays(3),
                'end_registration_time' => now()->addDays(4),
                'tournament_start_time' => now()->addDays(5),
                'size' => 8,
                'accepted_divisions' => json_encode(['B', 'C']),
                'status' => 'pending'
            ],
            [
                'name' => 'Турнир 3',
                'description' => 'Описание турнира 3',
                'start_time' => now()->addDays(4),
                'end_registration_time' => now()->addDays(5),
                'tournament_start_time' => now()->addDays(6),
                'size' => 8,
                'accepted_divisions' => json_encode(['C', 'D']),
                'status' => 'pending'
            ]
        ];

        foreach ($tournaments as $tournament) {
            Tournament::create($tournament);
        }
    }
}
