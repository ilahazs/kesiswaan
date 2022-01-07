<?php

use App\Http\Controllers\DashboardContoller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PelanggaranSiswaController;
use App\Http\Controllers\PenghargaanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RuleDataController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentPelanggaranController;
use App\Http\Controllers\StudentPenghargaanController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\IsAdmin;
use App\Models\Category;
use App\Models\Pelanggaran;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index', ['title' => 'Home']);
})->name('index');

Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

// Route::resource('/posts', PostController::class);
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login-authenticate');
Route::post('/logout',  [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Auth: Register
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register-authenticate');

// Dashboard especially for general User
// Route::middleware(['auth', 'second'])->group(function () {

// });
Route::get('/dashboard/', function () {
    return view('dashboard.index', [
        'title' => 'Home',
        'userName' => Auth::user()->name
    ]);
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/', [DashboardContoller::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/profile', [DashboardContoller::class, 'profile'])->name('dashboard.profile');
});

// Dashboard for as admin authority
Route::middleware([IsAdmin::class, 'auth'])->group(function () {
    Route::get('/dashboard/admin', function () {
        return view('dashboard.admin.user', [
            'title' => 'Admin Page',
            'users' => User::all()
        ]);
    })->name('admin.user');

    // Route::resource('/dashboard/ruledata', RuleDataController::class, ['as' => 'dashboard'])->except('show');

    Route::resource('/dashboard/pelanggaran', PelanggaranController::class, [
        'as' => 'dashboard'
    ]);
    Route::resource('/dashboard/penghargaan', PenghargaanController::class, [
        'as' => 'dashboard'
    ]);
    Route::resource('/dashboard/students', StudentController::class, [
        'as' => 'dashboard'
    ]);
    Route::resource('/pelanggaran/students', StudentPelanggaranController::class, [
        'as' => 'dashboard.pelanggaran'
    ]);
    Route::resource('/penghargaan/students', StudentPenghargaanController::class, [
        'as' => 'dashboard.penghargaan'
    ]);
});
/* Dashboard Students Controller */
// Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth')->name('dashboard.posts.checkSlug');

// data-penghargaan
// data-pelanggaran

// 
