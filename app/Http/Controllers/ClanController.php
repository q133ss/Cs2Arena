<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use Illuminate\Http\Request;

class ClanController extends Controller
{
    public function ratings()
    {
        $clans = Clan::orderBy('points', 'DESC')->get();
        return view('clan.ratings', compact('clans'));
    }

    public function members(Clan $clan)
    {
        return view('clan.members', [
            'clan' => $clan,
            'members' => $clan->members
        ]);
    }

    public function show(Clan $clan)
    {
        return view('clan.show', compact('clan'));
    }
}
