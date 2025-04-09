<?php

namespace App\Http\Controllers;

use App\Models\MixServer;
use App\Services\ApiService;
use Illuminate\Http\Request;

class MixController extends Controller
{
    public function index()
    {
        $service = new ApiService();
        $servicesList = MixServer::all()->toArray();
        $servers = $service->getServersWithInfo($servicesList);
        return view('mix.index', compact('servers'));
    }
}
