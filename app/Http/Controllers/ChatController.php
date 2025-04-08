<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $chats = auth()->user()->chats()->with('messages')->get();
        return view('chat.index', compact('chats'));
    }

    public function show(Chat $chat)
    {
        $chats = auth()->user()->chats()->with(['messages'])->get();

        $chat->load('messages.user');
        return view('chat.index', compact('chats', 'chat'));
    }

    public function storeMessage(Request $request, Chat $chat)
    {
        //
    }
}
