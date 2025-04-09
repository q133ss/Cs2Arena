<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::get();
        $statuses = [
            'pending' => 'Регистрация открыта',
            'active' => 'В процессе',
            'completed' => 'Завершен'
        ];
        return view('tournament.index', compact('statuses', 'tournaments'));
    }
}
