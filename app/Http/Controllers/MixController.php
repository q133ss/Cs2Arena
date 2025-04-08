<?php

namespace App\Http\Controllers;

use App\Models\MixServer;
use Illuminate\Http\Request;

class MixController extends Controller
{
    public function index()
    {
        $servers = MixServer::get();
        return view('mix.index', compact('servers'));
    }
}
