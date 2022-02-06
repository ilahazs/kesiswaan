<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardContoller extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'guru') {
            $k = '';
            $guru = '';
            foreach (Teacher::all() as $teacher) {
                if ($teacher->user_id == Auth::user()->id) {
                    $guru = $teacher;
                }
            }
            // dd($guru->nama);
            foreach (Kelas::all() as $kelas) {
                if ($kelas->teacher_id != null && $kelas->teacher_id == $guru->id) {
                    $k = $kelas;
                }
            }
            return view('dashboard.index', [
                'title' => 'Home', 'userName' => Auth::user()->name,
                'kelas' => $k,
                'guru' => $guru,
                'nip' => $guru->nip
            ]);
        }
        return view('dashboard.index', ['title' => 'Home', 'userName' => Auth::user()->name]);
    }
}
