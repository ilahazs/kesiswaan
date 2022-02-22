<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Teacher;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Validator;

class TeacherManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Kelas::orderBy('updated_at', 'desc')->get();
        // $jurusan = Kelas::pluck('jurusan')->toArray();
        // dd($jurusan);
        $tingkatan = [10, 11, 12];
        $jurusan = ['RPL', 'MM', 'TAVI', 'TKJ', 'TOI', 'TITL'];
        $urutan = [1, 2, 3];
        return view('dashboard.admin.teacher.index', [
            'title' => 'Semua Guru Walikeas',
            'teachers' => Teacher::orderBy('updated_at', 'desc')->get(),
        ], compact('tingkatan', 'jurusan', 'urutan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Buat User 
        $user = User::create([
            'name' => $request->nama,
            'username' => $request->nip,
            'tingkatan_kelas' => 'required',
            'jurusan_kelas' => 'required',
            'urutan_kelas' => 'required',
            'role' => 'guru',
            'email' => "$request->nip@gmail.com",
            'password' => Hash::make($request->nip)
        ]);

        // .. Buat guru
        $rules = [
            'nama' => 'required',
            'nip' => 'required',
        ];

        $validated = $request->validate($rules);
        $teacher = Teacher::create($validated);
        $kelasID = '';

        foreach (Kelas::all() as $kelas) {
            if ($request->tingkatan_kelas == $kelas->tingkatan && $request->jurusan_kelas == $kelas->jurusan && $request->urutan_kelas == $kelas->nama) {
                $kelasID = $kelas->id;
                Kelas::where('id', $kelasID)->update('teacher_id', $teacher->id);
            }
        }

        $userID = $user->where('username', $request->nip)->get()[0]->id;
        $teacher->user_id = $userID;
        $teacher->save();

        toastr()->success("Data Guru baru berhasil <strong>ditambahkan</strong>!");
        return redirect(route('teachers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
