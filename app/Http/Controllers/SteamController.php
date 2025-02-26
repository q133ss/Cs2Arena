<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SteamController extends Controller
{
    /**
     * Redirect the user to the Steam authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToSteam()
    {
        return Socialite::driver('steam')->redirect();
    }

    /**
     * Obtain the user information from Steam.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleSteamCallback()
    {
        try {
            $steamUser = Socialite::driver('steam')->user();

            // Найти или создать пользователя
            $user = User::firstOrCreate([
                'steam_id' => $steamUser->id,
            ], [
                'name' => $steamUser->nickname,
                'avatar' => $steamUser->avatar,
            ]);

            // Вход пользователя
            auth()->login($user, true);

            return to_route('profile');
        } catch (\Exception $e) {
            return to_route('index');
        }
    }
}
