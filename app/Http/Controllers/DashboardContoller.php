<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardContoller extends Controller
{
    public function index()
    {
        return view('dashboard.index', ['title' => 'Home', 'userName' => Auth::user()->name]);
    }

    public function profile()
    {
        return view('dashboard.profile', ['title' => 'Profile']);
    }
}
