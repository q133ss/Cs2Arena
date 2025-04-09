<?php

namespace Database\Seeders;

use App\Models\Math;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mathes = [
            [
                'server_id' => 1,
                'map' => 'de_dust2',
                'result' => [
                    'total' => 'disconnect',
                    'user1' => [
                        'id' => 1,
                        'frags' => 10,
                        'deaths' => 5,
                    ],
                    'user2' => [
                        'id' => 2,
                        'score' => 20,
                    ],
                ],
                'status' => 'finished',
                'created_at' => now()->subHour(),
            ],
            [
                'server_id' => 3,
                'map' => 'de_inferno',
                'result' => [
                    'total' => 'win',
                    'user1' => [
                        'id' => 1,
                        'frags' => 2,
                        'deaths' => 6,
                    ],
                    'user2' => [
                        'id' => 2,
                        'frags' => 10,
                        'deaths' => 5,
                    ],
                ],
                'status' => 'finished',
                'created_at' => now()->subMinutes(14),
            ],
            [
                'server_id' => 2,
                'map' => 'de_mirage',
                'result' => [
                    'total' => 'lose',
                    'user1' => [
                        'id' => 1,
                        'frags' => 18,
                        'deaths' => 7,
                    ],
                    'user2' => [
                        'id' => 2,
                        'frags' => 10,
                        'deaths' => 5,
                    ],
                ],
                'status' => 'in_progress',
                'created_at' => now()->subHours(5),
            ],
            [
                'server_id' => 2,
                'map' => 'de_mirage',
                'result' => [
                    'total' => 'win',
                    'user1' => [
                        'id' => 1,
                        'frags' => 7,
                        'deaths' => 12,
                    ],
                    'user2' => [
                        'id' => 2,
                        'frags' => 6,
                        'deaths' => 4,
                    ],
                ],
                'status' => 'in_progress',
                'created_at' => now()->subHours(5),
            ]
        ];

        $statuses = [
            '0' => 'in_progress',
            '1' => 'finished',
            '2' => 'disconnect'
        ];

        foreach ($mathes as $math){
            $math = Math::create($math);
            for ($i = 1; $i <= 10; $i++){
                DB::table('user_maths')->insert([
                    'user_id' => $i,
                    'math_id' => $math->id,
                    'status' => $statuses[rand(0,2)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
