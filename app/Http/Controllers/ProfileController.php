<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load(['posts', 'posts.files', 'posts.likes', 'posts.likes.user']);
        return view('profile.index', compact('user'));
    }

    public function show(User $user)
    {
        return view('profile.show', compact('user'));
    }
}
