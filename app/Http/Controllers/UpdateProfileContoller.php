<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UpdateProfileContoller extends Controller
{
    public function edit()
    {
        // dd(Auth::user()->role == 'siswa');
        if (auth()->user()->role == 'siswa') {
            $siswa = '';
            $pelanggarans = '';
            $siswas = Student::all();
            $userEmail = auth()->user()->email;
            $strChanged = str_replace("@", " ", $userEmail);
            $userNISDump = explode(" ", $strChanged);
            $userNIS = $userNISDump[0];

            foreach ($siswas as $s) {
                if ($s->user_id != null && $s->user_id == auth()->user()->id && $s->nis == $userNIS) {

                    $siswa = $s;
                    $pelanggarans = $s->pelanggarans;
                }
            }

            return view('dashboard.profile', [
                'title' => 'Profile',
                'student' => $siswa,
                'user' => auth()->user(),
                'pelanggarans' => $pelanggarans,
            ]);
        }
        return view('dashboard.profile', [
            'title' => 'Profile',
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request)
    {
        dd($request->all());
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required',
            // 'email' => 'required',
            // 'email' => 'required',
            'currentpassword' => 'required',
            'newpassword' => 'required',
            'repeatpassword' => 'required',
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
