<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Laporan;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tingkatan = [10, 11, 12];
        $jurusan = ['RPL', 'MM', 'TAVI', 'TKJ', 'TOI', 'TITL'];
        $urutan = [1, 2, 3];
        if (Auth::user()->role != 'admin') {
            $laporans = Laporan::where('pelapor_id', Auth::user()->id)->get();
            // dd($laporans);

            return view('dashboard.laporan.index', [
                'title' => 'Semua Laporan',
                // 'laporans' => Laporan::orderBy('updated_at', 'desc')->get(),
                'laporans' => $laporans,
            ], compact('tingkatan', 'jurusan', 'urutan'));
        }

        return view('dashboard.laporan.index', [
            'title' => 'Semua Laporan',
            'laporans' => Laporan::orderBy('updated_at', 'desc')->get(),
        ], compact('tingkatan', 'jurusan', 'urutan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tingkatan = [10, 11, 12];
        $jurusan = ['RPL', 'MM', 'TAVI', 'TKJ', 'TOI', 'TITL'];
        $urutan = [1, 2, 3];

        return view('dashboard.laporan.create', [
            'title' => 'Buat Laporan',
        ], compact('tingkatan', 'jurusan', 'urutan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'nama_pelaku' => 'required|max:255',
            'nis_pelaku' => 'required|min:8',
            'tingkatan_kelas' => 'required',
            'jurusan_kelas' => 'required',
            'urutan_kelas' => 'required',
            'jenis_kelamin' => 'required',
            'keterangan' => 'required',

        ];

        $requestData = $request->all();
        $concatKelas = '';

        foreach (Kelas::all() as $kelas) {
            if ($request->tingkatan_kelas == $kelas->tingkatan && $request->jurusan_kelas == $kelas->jurusan && $request->urutan_kelas == $kelas->nama) {
                $requestData['class_id'] = $kelas->id;
                $rules['class_id']  = 'required';
                $romawiTingkatan = '';

                switch ($kelas->tingkatan) {
                    case '10':
                        $romawiTingkatan = 'X';
                        break;
                    case '11':
                        $romawiTingkatan = 'XI';
                        break;
                    case '12':
                        $romawiTingkatan = 'XII';
                        break;
                    default:
                        $romawiTingkatan = 'None';
                        break;
                }
                $concatKelas = $romawiTingkatan . ' ' . $kelas->jurusan . ' ' . $kelas->nama;
                $requestData['kelas'] = $concatKelas;
                $rules['kelas']  = 'required';
            }
        }


        // $userEmail = Auth::user()->email;
        // $strChanged = str_replace("@", " ", $userEmail);
        // $userNISDump = explode(" ", $strChanged);
        // $userNIS = $userNISDump[0];

        // if (!empty($request->nis_pelaku)) {
        //     foreac
        // }


        foreach (User::all() as $user) {
            if ($user->username == $request->nis_pelaku || $user->name == $request->nama) {
                $requestData['user_id'] = $user->id;
                $requestData['nama_pelaku'] = $user->name;
                $requestData['email_pelaku'] = $user->email;
                $requestData['username_pelaku'] = $user->username;
                $rules['user_id']  = 'required';
                $rules['email_pelaku']  = 'required';
                $rules['nama_pelaku']  = 'required';
                $rules['username_pelaku']  = 'required';
            }


            if ($user->id == auth()->user()->id) {
                // dd($user);
                $requestData['pelapor_id'] = $user->id;
                $requestData['nama_pelapor'] = $user->name;
                $requestData['role_pelapor'] = $user->role;
                $requestData['email_pelapor'] = $user->email;
                $requestData['username_pelapor'] = $user->username;
                $rules['pelapor_id']  = 'required';
                $rules['nama_pelapor']  = 'required';
                $rules['role_pelapor']  = 'required';
                $rules['email_pelapor']  = 'required';
                $rules['username_pelapor']  = 'required';
            }
        }

        // dd($requestData);

        $request->merge(['class_id' => $requestData['class_id']]);
        $request->merge(['kelas' => $requestData['kelas']]);
        $request->merge(['user_id' => $requestData['user_id']]);
        $request->merge(['nama_pelaku' => $requestData['nama_pelaku']]);
        $request->merge(['email_pelaku' => $requestData['email_pelaku']]);
        $request->merge(['username_pelaku' => $requestData['username_pelaku']]);


        $request->merge(['pelapor_id' => $requestData['pelapor_id']]);
        $request->merge(['nama_pelapor' => $requestData['nama_pelapor']]);
        $request->merge(['role_pelapor' => $requestData['role_pelapor']]);
        $request->merge(['email_pelapor' => $requestData['email_pelapor']]);
        $request->merge(['username_pelapor' => $requestData['username_pelapor']]);

        // $validator = Validator::make($requestData, $rules);

        // if ($validator->fails()) {
        //     return redirect(route('laporan.index'))->withErrors($validator);
        // }
        // $validated = $validator->validate();

        $validatedData = $request->validate($rules);
        // dd($validatedData);  


        Laporan::create($validatedData);

        toastr()->success("Laporan baru berhasil <strong>dibuat</strong>!");
        return redirect(route('laporan.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $laporan)
    {
        $validated = $request->validate([
            'keterangan' => 'required',
            // 'nama_pelaku' => 'required',
            // 'nis_pelaku' => 'required',
            // 'email_pelaku' => 'required',
            // 'nis_pelaku' => 'required',
        ]);

        Laporan::where('id', $laporan->id)->update($validated);

        toastr()->success("Data Laporan berhasil <strong>diubah</strong>!");
        return redirect(route('laporan.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        //
    }
}
