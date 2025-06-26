<?php

use Illuminate\Support\Facades\Route;

# TODO Клан вар
# TODO Турины
# TODO Стата
# TODO чат ??
# TODO обновить фото в посте

/***************** CLAN WAR
 *
 * // Если юзер не авторизован, то показываем заглушку!
 * // Если он не главный в клане, то он не может начать!
 *
 * // Нужно отображать тех, кто онлайн! Отправить им приглашение в лобби!
 * // Владелец клана может создать клан. Выбрав участнинов и карту. Затем участиники должны подтвердить и начнется поиск
 * // Если хотя бы один не подтвердил, то клан не может начать поиск + если кто-то отменит тоже самое!
 *
 * ВЛАДЕЛЕЦ КЛАНА МОЖЕТ ОТПРАВИТЬ ПРИГЛАШЕНИЕ В КВ ДРУГОМУ КЛАНУ, ДРУГОЙ КЛАН ПОЛУЧАЕТ УВЕДОМЛЕНИЕ И ПРИНИМАЕТ ИЛИ ОТКАЗЫВАЕТСЯ
 *
 *****************/

# Для интеграции имеем следующее:
// Сервера от myarena
// Есть плагин MatchZy, он со статой
// https://shobhit-pathak.github.io/MatchZy/

// Есть так же с АПИ!!! https://github.com/akiver/cs-demo-manager

# TODO Статистика с миксов!
# TODO Full stat

# TODO для банов используется этот плагин: https://github.com/Iksix/Iks_Admin
// Там есть IksAdmin/Main.cs смотреть нужно его
// Там так же есть IksAdmin/Commands/Ban.cs

Route::view('/', 'index')->name('index');
Route::get('/steam/login', [\App\Http\Controllers\SteamController::class, 'login'])->name('steam.login');
Route::get('/steam/callback', [\App\Http\Controllers\SteamController::class, 'callback'])->name('steam.callback');

# TODO при клике в турнирной сетке переходить на страницу клана!

# TODO если лидер выходит из клана, то нужно передать права заму или удалить клан!!!

Route::get('qq', function (){
    \Auth()->loginUsingId(1);
});

Route::redirect('/login', '/')->name('login');

Route::get('/mix', [App\Http\Controllers\MixController::class, 'index'])->name('mix.index');
Route::get('/clan-war', [App\Http\Controllers\ClanWarController::class, 'index'])->name('cw.index');
Route::get('/clan-war/{id}', [App\Http\Controllers\ClanWarController::class, 'show'])->name('cw.show');
Route::get('/tournaments', [App\Http\Controllers\TournamentController::class, 'index'])->name('tournament.index');
// TODO добавить фильтрацию по рейтингу и тд
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
    Route::resource('post', App\Http\Controllers\PostController::class);
    Route::get('/logout', [App\Http\Controllers\LogoutController::class, 'logout'])->name('logout');
    // Кланы
    Route::get('/clans', [App\Http\Controllers\ClanController::class, 'index'])->name('clan.list');
    Route::get('/clans/create', [App\Http\Controllers\ClanController::class, 'create'])->name('clans.create');
    Route::post('/clans/create', [App\Http\Controllers\ClanController::class, 'store'])->name('clans.store');
    Route::post('/clans/{clan}/apply', [App\Http\Controllers\ClanApplicationController::class, 'apply'])->name('clans.apply');
    Route::post('/clan/applications/{app_id}/{action}', [App\Http\Controllers\ClanApplicationController::class, 'processApplication'])->name('clan.applications.process');
    Route::get('/clan/{id}/applications', [App\Http\Controllers\ClanApplicationController::class, 'allApplications'])->name('clan.applications.all');
    Route::delete('/clan/applications/{id}', [App\Http\Controllers\ClanApplicationController::class, 'destroy'])->name('clan.applications.delete');
    Route::post('/clan/leave/{id}', [App\Http\Controllers\ClanApplicationController::class, 'leave'])->name('leave.clan');
    // Прочитать уведомления
    Route::post('read-notifications', [App\Http\Controllers\NotificationController::class, 'readNotifications'])->name('notifications.read');
    Route::post('clan/like/{post}', [App\Http\Controllers\PostController::class, 'clanLike'])->name('clan.post.like');
    Route::post('like/{post}', [App\Http\Controllers\PostController::class, 'like'])->name('post.like');
    Route::post('post/{post}/complaint', [App\Http\Controllers\PostController::class, 'complaint'])->name('post.complaint');
    Route::post('clan/post/{clan_id}/store', [App\Http\Controllers\PostController::class, 'storeClan'])->name('post.clan.store');
    Route::get('clan/post/{clan_id}/edit', [App\Http\Controllers\PostController::class, 'editClanPost'])->name('post.clan.edit');
    Route::post('clan/post/{clan_id}/update', [App\Http\Controllers\PostController::class, 'updateClanPost'])->name('post.clan.update');
    Route::delete('clan/post/{clan_id}/delete', [App\Http\Controllers\PostController::class, 'deleteClanPost'])->name('post.clan.delete');
    // Друзья
    Route::post('/friends/{user}/send', [App\Http\Controllers\FriendshipController::class, 'sendRequest'])->name('friends.send.request');
    Route::post('/friends/{friendship}/accept', [App\Http\Controllers\FriendshipController::class, 'acceptRequest'])->name('friends.accept.request');
    Route::post('/friends/{friendship}/reject', [App\Http\Controllers\FriendshipController::class, 'rejectRequest'])->name('friends.reject.request');
    Route::delete('/friends/{friendship}', [App\Http\Controllers\FriendshipController::class, 'removeFriend'])->name('friends.remove.friend');
    Route::get('/friends/incoming', [App\Http\Controllers\FriendshipController::class, 'incomingRequests'])->name('friends.incoming.requests');
    Route::get('/friends/outgoing', [App\Http\Controllers\FriendshipController::class, 'outgoingRequests'])->name('friends.outgoing.requests');
    Route::get('/friends', [App\Http\Controllers\FriendshipController::class, 'friends'])->name('friends');
    Route::get('/friend/requests', [App\Http\Controllers\FriendshipController::class, 'friendRequests'])->name('friend.requests');
    // Битва кланов
    Route::post('clan-war/request/{clan_id}', [App\Http\Controllers\ClanWarController::class, 'request'])->name('cw.request');
    Route::get('clan-war/accept/{clan_id}', [App\Http\Controllers\ClanWarController::class, 'accept'])->name('cw.accept');
    Route::get('clan-war/reject/{clan_id}', [App\Http\Controllers\ClanWarController::class, 'reject'])->name('cw.reject');
});

# TODO сделать блог для SEO
# TODO убрать этот роут в view clan.list!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
Route::view('post', 'rating.how-to-increase')->name('rating.how-to-increase');

/*
ПРОТЕСТИТЬ СРАЗУ В seeder
- Админ создает туринр.
- набираем 8 команд например
- автоматическая жеребьевка (создаем рандомно матчи и откладываем им начало!)
- ВСЕ!

ПРИ ПОБЕДЕ В КВ МЫ ДАЕМ ОТЧКИ САМОМУ КЛАНУ + ИГРОКАМ CW_RANK
 */
