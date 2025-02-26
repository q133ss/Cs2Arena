<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('index');

Route::get('/steam/login', [\App\Http\Controllers\SteamController::class, 'login'])->name('steam.login');

Route::view('about', 'index')->name('about');
Route::view('contact', 'index')->name('contact');
Route::view('blog', 'index')->name('blog');
Route::view('faq', 'index')->name('faq');

Route::get('/profile', function (){
    dd(auth()->user());
})->name('profile.index');
/*
 * TODO
 * ПЕРЕДЕЛАТЬ ТАБЛИЦЫ С 0! РЕФАКТОР
 * ПОТОМУ ЧТО!
 * Где мне хранить статистику?
Где модели для чата?
Где посмотреть поданные заявки в кланы?
Где хранится избранное?

БУДЕМ ЧАТУ ГПТ СКАРМЛИВАТЬ КАЖДУЮ ТАБЛИЦУ ОТДЕЛЬНО ПО ОПИСАНИЮ А ЗАТЕМ РЕДАЧИМ ЕЕ САМИМ!
ЗАТЕМ МОДЕЛИРУЕМ СИТУАЦИЮ И ПРОВЕРЯЕМ ПО ТАБЛИЦАМ!!! НАПРИМЕР Я ВЫЙГРАЛ МАТЧ и ТД
ХРАНИТЬ РЕЗУЛЬТАТ В JSON БРЕД, ОНОВНЫЕ ДАННЫЕ НАДО ВЫНОСИТЬ, что бы поиск был по ним
||||

ПРОТЕСТИТЬ СРАЗУ В seeder
- Админ создает туринр.
- набираем 8 команд например
- автоматическая жеребьевка (создаем рандомно матчи и откладываем им начало!)
- ВСЕ!

ПРИ ПОБЕДЕ В КВ МЫ ДАЕМ ОТЧКИ САМОМУ КЛАНУ + ИГРОКАМ CW_RANK
 */
