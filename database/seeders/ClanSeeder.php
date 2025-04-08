<?php

namespace Database\Seeders;

use App\Models\Clan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clans = [
            [
                'name' => 'Клан 1',
                'motto' => 'Девиз клана 1!!',
                'description' => 'Это клан 1',
                'leader_id' => 1,
                'avatar_url' => '/assets/images/cs2-bg.png',
                'minimal_rating' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Клан 2',
                'motto' => 'Девиз клана 2!!',
                'description' => 'Это клан 2',
                'leader_id' => 1,
                'avatar_url' => '/assets/images/cs2-bg.png',
                'minimal_rating' => 2000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Клан 3',
                'motto' => 'Девиз клана 3!!',
                'description' => 'Это клан 3',
                'leader_id' => 1,
                'avatar_url' => '/assets/images/cs2-bg.png',
                'minimal_rating' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Клан 4',
                'motto' => 'Девиз клана 4!!',
                'description' => 'Это клан 4',
                'leader_id' => 1,
                'avatar_url' => '/assets/images/cs2-bg.png',
                'minimal_rating' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Клан 5',
                'motto' => 'Девиз клана 5!!',
                'description' => 'Это клан 5',
                'leader_id' => 1,
                'avatar_url' => '/assets/images/cs2-bg.png',
                'minimal_rating' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Клан 6',
                'motto' => 'Девиз клана 6!!',
                'description' => 'Это клан 6',
                'leader_id' => 1,
                'avatar_url' => '/assets/images/cs2-bg.png',
                'minimal_rating' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Клан 7',
                'motto' => 'Девиз клана 7!!',
                'description' => 'Это клан 7',
                'leader_id' => 1,
                'avatar_url' => '/assets/images/cs2-bg.png',
                'minimal_rating' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Клан 8',
                'motto' => 'Девиз клана 8!!',
                'description' => 'Это клан 8',
                'leader_id' => 1,
                'avatar_url' => '/assets/images/cs2-bg.png',
                'minimal_rating' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($clans as $clan){
            $modelClan = Clan::create($clan);

            for($i = 0; $i >= rand(8,22); $i++){
                $user = User::create([
                    'steam_id' => rand(100,999).rand(100,999).rand(100,999).rand(100,999).rand(10,99).rand(100,999),
                    'username' => uniqid('steam_user_'),
                    'avatar_url' => 'https://avatars.fastly.steamstatic.com/c8146423076bd1a2fbe510c1b683499b6952fc34_full.jpg',
                    'country' => 'Russia',
                    'email' => uniqid('mail').'@gmail.com'
                ]);

                DB::table('clan_members')->insert([
                    'user_id' => $user->id,
                    'clan_id' => $modelClan->id,
                    'role' => $i == 1 ? 'owner' : 'member',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
