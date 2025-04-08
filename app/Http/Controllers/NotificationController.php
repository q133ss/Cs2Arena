<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->orderBy('created_at', 'desc')->simplePaginate(15);
        Carbon::setLocale('ru');
        return view('notifications.index', compact('notifications'));
    }
}
