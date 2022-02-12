<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggarans = Pelanggaran::orderBy('updated_at', 'desc')->get();

        return view('dashboard.pelanggaran.index',  [
            'title' => 'Data Pelanggaran',
        ], compact('pelanggarans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = ['ringan', 'sedang', 'berat'];

        return view('dashboard.pelanggaran.create', [
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
            'keterangan' => 'max:255',
        ];

        $requestData = $request->all();

        if ($request->jenis == 'ringan') {
            $requestData['poin'] = 20;
            $rules['poin'] = 'required';
        } elseif ($request->jenis == 'sedang') {
            $requestData['poin'] = 30;
            $rules['poin'] = 'required';
        } elseif ($request->jenis == 'berat') {
            $requestData['poin'] = 50;
            $rules['poin'] = 'required';
        }


        $request->merge(['poin' => $requestData['poin']]);
        // return $request->all();

        $validatedData = $request->validate($rules);

        Pelanggaran::create($validatedData);
        $title = $validatedData['nama'];
        toastr()->success("Data Pelanggaran baru berhasil <strong>ditambahkan</strong>!");
        return redirect(route('pelanggaran.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelanggaran  $pelanggaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pelanggaran $pelanggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelanggaran  $pelanggaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggaran $pelanggaran)
    {
        $jenis = ['ringan', 'sedang', 'berat'];

        return view('dashboard.pelanggaran.edit', [
            'title' => 'Ubah Data Pelanggaran',
        ], compact('jenis', 'pelanggaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelanggaran  $pelanggaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelanggaran $pelanggaran)
    {
        // dd($request->jenis);
        $rules = [
            'nama' => 'required',
            'keterangan' => 'required|max:255',
            'poin' => 'required',
        ];

        $requestData = $request->all();

        if ($request->jenis == 'ringan') {
            $requestData['poin'] = 20;
            $rules['poin'] = 'required';
        } elseif ($request->jenis == 'sedang') {
            $requestData['poin'] = 30;
            $rules['poin'] = 'required';
        } elseif ($request->jenis == 'berat') {
            $requestData['poin'] = 50;
            $rules['poin'] = 'required';
        }
        // dd($requestData);
        $request->merge(['poin' => $requestData['poin']]);
        // return $request->all();
        $validatedData = $request->validate($rules);
        Pelanggaran::where('id', $pelanggaran->id)->update($validatedData);
        $title = $pelanggaran->nama;
        toastr()->success("Data Pelanggaran <strong>$title</strong> berhasil <strong>diubah</strong>!");
        return redirect(route('pelanggaran.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelanggaran  $pelanggaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggaran $pelanggaran)
    {
        $title = $pelanggaran->nama;
        Pelanggaran::destroy($pelanggaran->id);
        // toastr()->error('Error Message');
        // toastr()->info('Info Message');
        // toastr()->warning('<Wa></Wa>a></Wa>rning Message');
        toastr()->success("Data Pelanggaran <strong>$title</strong> berhasil <strong>dihapus</strong>!");
        return redirect(route('pelanggaran.index'));
    }
}
