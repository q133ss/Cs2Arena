<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'steam_id' => '76561199784509257',
            'username' => 'lexa36rus4',
            'avatar_url' => 'https://avatars.fastly.steamstatic.com/c8146423076bd1a2fbe510c1b683499b6952fc34_full.jpg',
            'social_links' => [],
            'country' => 'Russia',
            'email' => 'blockstar2k@gmail.com'
        ]);
    }
}
