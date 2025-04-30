<?php

use Illuminate\Support\Facades\Route;

# TODO Clan CRUD + Invite
# TODO друзья, чат
# TODO Клан вар

# TODO Статистика с миксов!
# TODO Full stat

Route::view('/', 'index')->name('index');
Route::get('/steam/login', [\App\Http\Controllers\SteamController::class, 'login'])->name('steam.login');
Route::get('/steam/callback', [\App\Http\Controllers\SteamController::class, 'callback'])->name('steam.callback');

# TODO при клике в турнирной сетке переходить на страницу клана!

Route::get('qq', function (){
    \Auth()->loginUsingId(1);
});

Route::redirect('/login', '/')->name('login');

Route::get('/mix', [App\Http\Controllers\MixController::class, 'index'])->name('mix.index');
Route::get('/clan-war', [App\Http\Controllers\ClanWarController::class, 'index'])->name('cw.index');
Route::get('/tournaments', [App\Http\Controllers\TournamentController::class, 'index'])->name('tournament.index');
Route::get('/clan-ratings', [App\Http\Controllers\ClanController::class, 'ratings'])->name('clan.ratings');
Route::get('/clan-members/{clan}', [App\Http\Controllers\ClanController::class, 'members'])->name('clan.members');
Route::get('/clan/{clan}', [App\Http\Controllers\ClanController::class, 'show'])->name('clan.show');
Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    # TODO чат может быть груповой!!!!!
    # TODO дискрода нет! Значит делаем тут голосовой созвон!
    Route::get('/chats', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{chat}', [App\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{chat}/message', [App\Http\Controllers\ChatController::class, 'storeMessage'])->name('chat.message.store');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/logout', [App\Http\Controllers\LogoutController::class, 'logout'])->name('logout');
    // Кланы
    Route::get('/clans', [App\Http\Controllers\ClanController::class, 'index'])->name('clan.list');
    Route::get('/clans/create', [App\Http\Controllers\ClanController::class, 'create'])->name('clans.create');
    Route::post('/clans/create', [App\Http\Controllers\ClanController::class, 'store'])->name('clans.store');
    Route::post('/clans/{clan}/apply', [App\Http\Controllers\ClanApplicationController::class, 'apply'])->name('clans.apply');
    Route::post('/clan/applications/{app_id}/{action}', [App\Http\Controllers\ClanApplicationController::class, 'processApplication'])->name('clan.applications.process');
    Route::get('/clan/{id}/applications', [App\Http\Controllers\ClanApplicationController::class, 'allApplications'])->name('clan.applications.all');
    Route::delete('/clan/applications/{id}', [App\Http\Controllers\ClanApplicationController::class, 'destroy'])->name('clan.applications.delete');
});

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
