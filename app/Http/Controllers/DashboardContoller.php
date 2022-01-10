<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardContoller extends Controller
{
    public function index()
    {
        return view('dashboard.index', ['title' => 'Home', 'userName' => Auth::user()->name]);
    }
}
