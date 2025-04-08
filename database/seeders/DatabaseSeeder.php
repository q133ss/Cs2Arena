<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(NotificationSeeder::class);
        $this->call(ClanSeeder::class);
        $this->call(ServerSeeder::class);
        $this->call(ClanWarSeeder::class);
        $this->call(TournamentSeeder::class);
        $this->call(ChatSeeder::class);
    }
}
