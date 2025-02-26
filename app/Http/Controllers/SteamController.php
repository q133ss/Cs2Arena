<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SteamController extends Controller
{
    public function login()
    {
        $user = User::first();
        auth()->login($user);
        return to_route('profile.index');
    }
}
