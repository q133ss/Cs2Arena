<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('index');
Route::get('/steam/login', [\App\Http\Controllers\SteamController::class, 'login'])->name('steam.login');

Route::get('/notifications', function (){
    return "Уведомления";
})->name('notifications');

Route::get('/chats', function (){
    return "Список чатов";
})->name('chat.index');

Route::get('/profile', function (){
    return "Профиль";
})->name('profile.index');

Route::get('/logout', function (){
    return "Выйти";
})->name('logout');

Route::get('/mix', function (){
    return "Микс";
})->name('mix.index');

Route::get('/clan-war', function (){
    return "Битва кланов";
})->name('cw.index');

Route::get('/tournaments', function (){
    return "Туринры";
})->name('tournament.index');

Route::get('/clan-ratings', function (){
    return "Рейтинг кланов";
})->name('clan.ratings');

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
