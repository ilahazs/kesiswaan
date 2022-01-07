<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Siswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'siswa') {
            return $next($request);
        }
        return redirect('/')->with('status-role', 'This page is not belongs to you! ');
    }
}
