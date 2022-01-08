<?php

namespace App\Http\Controllers;

use App\Models\Penghargaan;
use Illuminate\Http\Request;

class PenghargaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penghargaans = Penghargaan::orderBy('updated_at', 'desc')->get();

        return view('dashboard.penghargaan.index',  [
            'title' => 'Data Penghargaan',
        ], compact('penghargaans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = ['ringan', 'sedang', 'tinggi'];

        return view('dashboard.penghargaan.create', [
            'title' => 'Tambah Data Baru',
        ], compact('jenis'));
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
            'nama' => 'required',
            'jenis' => 'required',
        ];

        $requestData = $request->all();

        if ($request->jenis == 'ringan') {
            $requestData['poin'] = 20;
            $rules['poin'] = 'required';
        } elseif ($request->jenis == 'sedang') {
            $requestData['poin'] = 30;
            $rules['poin'] = 'required';
        } elseif ($request->jenis == 'tinggi') {
            $requestData['poin'] = 50;
            $rules['poin'] = 'required';
        }


        $request->merge(['poin' => $requestData['poin']]);
        // return $request->all();

        $validatedData = $request->validate($rules);

        Penghargaan::create($validatedData);
        $title = $validatedData['nama'];

        return redirect(route('penghargaan.index'))->with('success', "Data Penghargaan Baru: <strong>$title</strong> berhasil <strong>ditambahkan</strong>!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penghargaan  $penghargaan
     * @return \Illuminate\Http\Response
     */
    public function show(Penghargaan $penghargaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penghargaan  $penghargaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penghargaan $penghargaan)
    {
        $jenis = ['ringan', 'sedang', 'tinggi'];

        return view('dashboard.penghargaan.edit', [
            'title' => 'Edit Data Penghargaan',
        ], compact('jenis', 'penghargaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penghargaan  $penghargaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penghargaan $penghargaan)
    {
        // dd($request->jenis);
        $rules = [
            'nama' => 'required',
            'keterangan' => 'required',
            'poin' => 'required',
        ];

        $requestData = $request->all();

        if ($request->jenis == 'ringan') {
            $requestData['poin'] = 20;
            $rules['poin'] = 'required';
        } elseif ($request->jenis == 'sedang') {
            $requestData['poin'] = 30;
            $rules['poin'] = 'required';
        } elseif ($request->jenis == 'tinggi') {
            $requestData['poin'] = 50;
            $rules['poin'] = 'required';
        }
        // dd($requestData);
        $request->merge(['poin' => $requestData['poin']]);
        // return $request->all();
        $validatedData = $request->validate($rules);
        Penghargaan::where('id', $penghargaan->id)->update($validatedData);
        $title = $penghargaan->nama;

        return redirect(route('penghargaan.index'))->with('success', "Data Penghargaan: <strong>$title</strong> berhasil <strong>diubah</strong>!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penghargaan  $penghargaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penghargaan $penghargaan)
    {
        $title = $penghargaan->nama;
        Penghargaan::destroy($penghargaan->id);

        return redirect(route('dashboard.penghargaan.index'))->with('success', "Data Penghargaan: <strong>$title</strong> berhasil <strong>dihapus</strong>!");
    }
}
