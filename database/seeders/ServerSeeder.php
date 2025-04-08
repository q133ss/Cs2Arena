<?php

namespace Database\Seeders;

use App\Models\MixServer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servers = [
            [
                'name' => 'Сервер 1',
                'ip_address' => '37.230.228.9:27015',
                'max_players' => 32
            ],
            [
                'name' => 'Сервер 2',
                'ip_address' => '46.174.48.164:27015',
                'max_players' => 30
            ],
            [
                'name' => 'Сервер 3',
                'ip_address' => '46.174.51.152:27015',
                'max_players' => 30
            ],
            [
                'name' => 'Сервер 4',
                'ip_address' => '46.174.48.234:27015',
                'max_players' => 30
            ],
            [
                'name' => 'Сервер 5',
                'ip_address' => '46.174.49.202:27015',
                'max_players' => 22
            ],
            [
                'name' => 'Сервер 6',
                'ip_address' => '85.119.149.215:27115',
                'max_players' => 32
            ],
            [
                'name' => 'Сервер 7',
                'ip_address' => '46.174.55.19:27015',
                'max_players' => 30
            ],
            [
                'name' => 'Сервер 8',
                'ip_address' => '212.22.85.57:11111',
                'max_players' => 32
            ],
        ];

        foreach ($servers as $server) {
            MixServer::create($server);
        }
    }
}
