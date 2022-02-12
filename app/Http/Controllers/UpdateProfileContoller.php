<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UpdateProfileContoller extends Controller
{
    public function edit()
    {
        if (auth()->user()->role == 'siswa') {
            $siswa = '';
            $poinPenghargaan = 0;
            $poinPelanggaran = 0;
            $siswas = Student::all();
            $userEmail = Auth::user()->email;
            $strChanged = str_replace('@', ' ', $userEmail);
            $userNISDump = explode(' ', $strChanged);
            $userNIS = $userNISDump[0];

            foreach ($siswas as $s) {
                // $smendekati = $s->user_id == Auth::user()->id;
                if ($s->user_id != null && $s->user_id == Auth::user()->id && $s->nis == $userNIS) {
                    // dd($s->pelanggarans);
                    // dd($s->nis);
                    $siswa = $s;
                    $poinPenghargaan = $s->poin_penghargaan;
                    $poinPelanggaran = $s->poin_pelanggaran;
                }
            }
            // dd($siswa);
            return view('dashboard.profile', [
                'title' => 'Profile',
                'student' => $siswa,
                'user' => auth()->user(),
                'nis' => $siswa->nis,
            ], compact('poinPenghargaan', 'poinPelanggaran'));
        }

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
            return view('dashboard.profile', [
                'title' => 'Home',
                'kelas' => $k,
                'guru' => $guru,
                'nip' => $guru->nip,
                'user' => auth()->user(),
            ]);
        }
        return view('dashboard.profile', [
            'title' => 'Profile',
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required',
            // 'email' => 'required',
            // 'email' => 'required',
            // 'currentpassword' => 'required',
            // 'newpassword' => 'required',
            // 'repeatpassword' => 'required',
        ];

        // if ($request->nis != $student->nis) {
        //     $rules['nis'] = 'required|unique:students';
        // }
        // $requestData = $request->all();
        // foreach (Kelas::all() as $kelas) {
        //     if ($request->tingkatan_kelas == $kelas->tingkatan && $request->jurusan_kelas == $kelas->jurusan && $request->urutan_kelas == $kelas->nama) {
        //         $requestData['class_id'] = $kelas->id;
        //         $rules['class_id']  = 'required';
        //     }
        // }

        // $request->merge(['class_id' => $requestData['class_id']]);

        $validatedData = $request->validate($rules);
        // User::where('id', Auth::user()->id)->update($validatedData);
        Auth::user()->update($validatedData);


        return redirect(route('dashboard.index'))->with('success', "Data kredentialmu telah berhasil <strong>diubah!</strong>");
    }
}
