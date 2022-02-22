<?php

use App\Http\Controllers\DashboardContoller;
use App\Http\Controllers\KlasifikasiPelanggaranController;
use App\Http\Controllers\KlasifikasiPenghargaanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PenghargaanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDismissPelanggaranController;
use App\Http\Controllers\StudentPelanggaranController;
use App\Http\Controllers\StudentPenghargaanController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherManageController;
use App\Http\Controllers\UpdateProfileContoller;
use App\Http\Controllers\UserManageController;
use App\Http\Middleware\Guru;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\Siswa;
use App\Models\Kelas;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index', ['title' => 'Home']);
})->name('index');

Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

/* // Route::resource('/posts', PostController::class);
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show'); */

// Login
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
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



    Route::prefix('profile')->group(function () {
        Route::get('edit', [UpdateProfileContoller::class, 'edit'])->name('profile');
        Route::put('update', [UpdateProfileContoller::class, 'update'])->name('profile.update');
    });
});

// Dashboard for as admin authority
Route::middleware([IsAdmin::class, 'auth'])->group(function () {
    Route::get('/dashboard/admin', function () {
        return view('dashboard.admin.user', [
            'title' => 'Admin Page',
            'users' => User::all()
        ]);
    })->name('admin.user');
    /* Memasukkan rekap Pelanggaran dan Penghargaan */
    Route::put('/hapus-pelanggaran/students/{student}', [StudentDismissPelanggaranController::class, 'dismisspelanggarandata'])->name('pelanggaran.students.dismissdata');
    Route::get('/hapus-pelanggaran/students/{student}/dismiss', [StudentDismissPelanggaranController::class, 'dismisspelanggaranview'])->name('pelanggaran.students.dismiss');

    Route::put('/hapus-penghargaan/students/{student}', [StudentDismissPelanggaranController::class, 'dismisspenghargaandata'])->name('penghargaan.students.dismissdata');
    Route::get('/hapus-penghargaan/students/{student}/dismiss', [StudentDismissPelanggaranController::class, 'dismisspenghargaanview'])->name('penghargaan.students.dismiss');


    Route::resource('/pelanggaran/students', StudentPelanggaranController::class, [
        'as' => 'pelanggaran'
    ]);
    Route::resource('/penghargaan/students', StudentPenghargaanController::class, [
        'as' => 'penghargaan'
    ]);

    /* Pengelola students */
    Route::resource('/students', StudentController::class);
    Route::get('/students/export', [StudentController::class, 'exportview'])->name('exportview');

    Route::get('export', [StudentController::class, 'exportstudents'])->name('exportstudents');

    /* Pelanggaran dan Penghargaan */
    Route::resource('/pelanggaran', PelanggaranController::class);
    Route::resource('/klasifikasi-pelanggaran', KlasifikasiPelanggaranController::class);
    Route::resource('/penghargaan', PenghargaanController::class);
    Route::resource('/klasifikasi-penghargaan', KlasifikasiPenghargaanController::class);

    /* Manage Data */
    /* Manage User */
    Route::resource('/users', UserManageController::class);

    /* Manage Teacher */
    Route::resource('/teachers', TeacherManageController::class);
});

Route::middleware([Siswa::class, 'auth'])->group(function () {
    /* Khusus untuk role siswa */
    Route::get('/siswa/rekap', function () {
        // $student = Student::where('id', Auth::user()->student_id)->get();
        // Check and assign data for student who is have relation with user


        $siswa = '';
        $pelanggarans = '';
        $siswas = Student::all();
        $userEmail = Auth::user()->email;
        $strChanged = str_replace("@", " ", $userEmail);
        $userNISDump = explode(" ", $strChanged);
        $userNIS = $userNISDump[0];
        // dd($userNIS);
        // dd(Auth::user()->id);
        foreach ($siswas as $s) {
            // $smendekati = $s->user_id == Auth::user()->id;
            // if ($s->user_id == Auth::user()->id) {
            //     dd('yeah');
            // }
            // dd($s->user_id);

            if ($s->user_id != null && $s->user_id == Auth::user()->id && $s->nis == $userNIS) {
                // dd($s);
                // dd($s->nis);
                $siswa = $s;
                $pelanggarans = $s->pelanggarans;
            }
        }
        // dd($s->user_id);
        // dd($siswa->pelanggarans());
        return view('dashboard.siswa-pages.rekap', [
            'title' => 'Data Rekapku',
            'student' => $siswa,
            'pelanggarans' => $pelanggarans,
        ]);
    })->name('siswa.rekap');

    Route::get('/siswa/shop', function () {

        $siswa = '';
        $mypoin = 0;
        $siswas = Student::all();
        $userEmail = Auth::user()->email;
        $strChanged = str_replace("@", " ", $userEmail);
        $userNISDump = explode(" ", $strChanged);
        $userNIS = $userNISDump[0];

        foreach ($siswas as $s) {
            // $smendekati = $s->user_id == Auth::user()->id;
            if ($s->user_id != null && $s->user_id == Auth::user()->id && $s->nis == $userNIS) {
                // dd($s->pelanggarans);
                // dd($s->nis);
                $siswa = $s;
                $mypoin = $s->poin_penghargaan;
            }
        }
        return view('dashboard.siswa-pages.shop', [
            'title' => 'Shop Poin',
            'student' => $siswa,
            'mypoin' => $siswa->poin_penghargaan,
        ]);
    })->name('siswa.shop');
});

Route::middleware([Guru::class, 'auth'])->group(function () {
    /* Khusus untuk role siswa */
    Route::get('/guru/rekap', function () {
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

        $students = Student::where('class_id', $k->id)->get();

        // Student::where('id', 7)->update([
        //     'notelp' => '081324086956'
        // ]);

        return view('dashboard.guru-pages.rekap', [
            'title' => 'Data Kelasku',
            'students' => $students,
            // 'pelanggarans' => $pelanggarans,
        ]);
    })->name('guru.rekap');

    Route::get('/guru', function () {
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
        return view('dashboard.guru-pages.guru', [
            'title' => 'Data Guru',
            'guru' => $guru,
            'kelas' => $k
        ]);
    })->name('guru.index');

    Route::get('exportkelas', [TeacherController::class, 'export_students_kelas'])->name('exportkelas');
});
