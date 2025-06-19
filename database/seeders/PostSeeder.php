<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'От школьных друзей до профессиональных команд: Роль лиги ESEA в CS2',
                'text' => 'ESEA League всегда была неотъемлемой частью соревновательного Counter-Strike, вливая свежие таланты в профессиональную сцену. В последнее время она становится все более популярным вариантом для казуальных игроков, которые просто хотят выйти за рамки FACEIT-матчей. Я имею в виду, что даже я сыграл пару сезонов Лиги, и я далеко не профессиональный игрок (давайте не будем проверять статистику в моем профиле, спасибо).',
            ],
            [
                'title' => 'Начните свой соревновательный путь в Лиге ESEA Сезон 52',
                'text' => 'Сделайте первый шаг в соревновательную командную игру и заработайте свои первые очки в региональном зачете Valve с помощью ESEA League, стартующей 8 января! Участвуйте в еженедельных официальных матчах, сбалансированных для команд вашего уровня и ориентированных на ваше расписание!',
                'photos' => [
                    'https://csmarket.gg/blog/wp-content/uploads/2024/05/ss_d830cfd0550fbb64d80e803e93c929c3abb02056.1920x1080.webp',
                    'https://betboost.ru/wp-content/uploads/2024/10/kak-ubrat-botov-v-ks-2.webp.webp'
                ],
            ],
            [
                'title' => 'Thorin: «M0NESY с Falcons войдут в топ-4 BLAST Austin Major 2025»',
                'text' => 'Аналитик CS2 Данкан Thorin Шилдс предположил возможные достижения Team Falcons на BLAST.tv Austin Major 2025 после слухов о переходе Ильи m0NESY Осипова в основной состав арабской команды. Он считает, что у Team Falcons есть шанс войти в топ-4.',
                'photos' => [
                    'https://www.vpesports.com/wp-content/uploads/2024/06/Screenshot_2-127.png',
                    'https://www.vpesports.com/wp-content/uploads/2024/06/Screenshot_1-126.png',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTh0HCJJScwJxk1ZzO7YP5Acjgi3xuIhzpkcg&s'
                ]
            ]
        ];

        foreach ($posts as $post) {
            $post['user_id'] = 1;
            $files = $post['photos'] ?? null;
            unset($post['photos']);

            $post = Post::create($post);
            if($files != null){
                foreach ($files as $file) {
                    File::create([
                        'fileable_type' => Post::class,
                        'fileable_id' => $post->id,
                        'src' => $file,
                        'category' => 'file'
                    ]);
                }
            }

            User::inRandomOrder()->take(rand(0,55))->get()->each(function ($user) use ($post) {
                $post->likes()->create([
                    'user_id' => $user->id
                ]);
            });
        }
    }
}
