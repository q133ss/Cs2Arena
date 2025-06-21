<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    /**
     * Отправить заявку в друзья
     */
    public function sendRequest(Request $request, User $user)
    {
        // Проверяем, не отправили ли уже заявку
        $existingRequest = Friendship::where('user_id', Auth::id())
            ->where('friend_id', $user->id)
            ->first();

        if ($existingRequest) {
            return back()->with('success', 'Заявка уже отправлена');
        }

        // Создаем новую заявку
        $friendship = Friendship::create([
            'user_id' => Auth::id(),
            'friend_id' => $user->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Заявка отправлена');
    }

    /**
     * Принять заявку в друзья
     */
    public function acceptRequest(Friendship $friendship)
    {
        // Проверяем, что текущий пользователь — получатель заявки
        if ($friendship->friend_id !== Auth::id()) {
            return response()->json(['message' => 'Недостаточно прав'], 403);
        }

        // Обновляем статус заявки
        $friendship->update(['status' => 'accepted']);

        return back()->with('success', 'Заявка принята');
    }

    /**
     * Отклонить заявку в друзья
     */
    public function rejectRequest(Friendship $friendship)
    {
        // Проверяем, что текущий пользователь — получатель заявки
        if ($friendship->friend_id !== Auth::id()) {
            return response()->json(['message' => 'Недостаточно прав'], 403);
        }

        // Обновляем статус заявки
        $friendship->update(['status' => 'rejected']);

        return back()->with('success', 'Заявка отклонена');
    }

    /**
     * Удалить из друзей или отменить заявку
     */
    public function removeFriend(Friendship $friendship)
    {
        // Проверяем, что текущий пользователь связан с этой дружбой
        if ($friendship->user_id !== Auth::id() && $friendship->friend_id !== Auth::id()) {
            return response()->json(['message' => 'Недостаточно прав'], 403);
        }

        $friendship->delete();

        return back()->with('success', 'Удалено');
    }

    /**
     * Получить список входящих заявок в друзья
     */
    public function incomingRequests()
    {
        $requests = Friendship::with('user')
            ->where('friend_id', Auth::id())
            ->where('status', 'pending')
            ->get();

        return response()->json(['requests' => $requests]);
    }

    /**
     * Получить список исходящих заявок в друзья
     */
    public function outgoingRequests()
    {
        $requests = Friendship::with('friend')
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->get();

        return response()->json(['requests' => $requests]);
    }

    /**
     * Получить список друзей
     */
    public function friends()
    {
        $friends = Friendship::with('friend')
            ->where(function ($query) {
                $query->where('user_id', Auth::id())
                    ->orWhere('friend_id', Auth::id());
            })
            ->where('status', 'accepted')
            ->get()
            ->map(function ($friendship) {
                return $friendship->user_id === Auth::id()
                    ? $friendship->friend
                    : $friendship->user;
            });

        return response()->json(['friends' => $friends]);
    }

    public function friendRequests()
    {
        $incoming = Friendship::with('user')
            ->where('friend_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        $outgoing = Friendship::with('friend')
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        return view('profile.requests', [
            'incomingRequests' => $incoming,
            'outgoingRequests' => $outgoing,
            'user' => auth()->user()
        ]);
    }
}
