<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('index');
Route::get('/steam/login', [\App\Http\Controllers\SteamController::class, 'login'])->name('steam.login');

# TODO при клике в турнирной сетке переходить на страницу клана!
# TODO все данные из БД!!!!!
# TODO реальные сервера из БД!!!!

Route::get('qq', function (){
    \Auth()->loginUsingId(1);
});

Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
Route::get('/chats', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
Route::get('/logout', [App\Http\Controllers\LogoutController::class, 'logout'])->name('logout');
Route::get('/mix', [App\Http\Controllers\MixController::class, 'index'])->name('mix.index');
Route::get('/clan-war', [App\Http\Controllers\ClanWarController::class, 'index'])->name('cw.index');
Route::get('/tournaments', [App\Http\Controllers\TournamentController::class, 'index'])->name('tournament.index');
Route::get('/clan-ratings', [App\Http\Controllers\ClanWarController::class, 'ratings'])->name('clan.ratings');

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
