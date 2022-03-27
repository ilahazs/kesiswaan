<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Student;
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
            'title' => 'Semua Guru Walikelas',
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
        $kelasID = 0;

        foreach (Kelas::all() as $kelas) {
            if ($request->tingkatan_kelas == $kelas->tingkatan && $request->jurusan_kelas == $kelas->jurusan && $request->urutan_kelas == $kelas->nama) {
                $kelasID = $kelas->id;
                $kelasUbah = $kelas;
                $kelasUbah->teacher_id = $teacher->id;
                $kelasUbah->save();
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
        // dd($request->all());
        $rules = [
            'nama' => 'required',
            'nip' => 'required',
            'tingkatan_kelas' => 'required',
            'jurusan_kelas' => 'required',
            'urutan_kelas' => 'required',
        ];

        if ($request->nip != $teacher->nip) {
            $nipOld = $teacher->nip;
            $rules['nip'] = 'required|unique:teachers';
            $teacher->nip = $request->nip;
            $teacher->save();

            $user = User::where('username', $nipOld)->get()[0];
            $user->username = $request->nip;
            $user->email = "$request->nip@gmail.com";
            $user->save();
        }

        if ($request->tingkatan_kelas != $teacher->kelas->tingkatan || $request->jurusan_kelas != $teacher->kelas->jurusan || $request->urutan_kelas != $teacher->kelas->nama) {
            foreach (Kelas::all() as $kelas) {
                if ($kelas->teacher_id == $teacher->id) {
                    $kelas->teacher_id = null;
                    $kelas->save();
                    // dd('berhasil');
                }
            }
        }

        foreach (Kelas::all() as $kelas) {
            if ($request->tingkatan_kelas == $kelas->tingkatan && $request->jurusan_kelas == $kelas->jurusan && $request->urutan_kelas == $kelas->nama) {
                // dd($kelas);  
                $kelas->teacher_id = $teacher->id;
                $kelas->save();
            }
        }

        $title = $teacher->nama;
        toastr()->success("Data Guru $title berhasil <strong>diubah</strong>!");
        return redirect(route('teachers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $title = $teacher->nama;
        Teacher::destroy($teacher->id);

        $kelas = Kelas::where('teacher_id', $teacher->id)->get()[0];
        $kelas->teacher_id = null;
        $kelas->save();

        $user = User::where('username', $teacher->nip)->get()[0];
        User::destroy($user->id);


        toastr()->success("Data Guru $title berhasil <strong>dihapus</strong>!");
        return redirect(route('teachers.index'));
    }
}
