<?php

namespace App\Http\Controllers;

use App\Models\KlasifikasiPenghargaan;
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
        $jenisKlasifikasi = KlasifikasiPenghargaan::get();

        return view('dashboard.penghargaan.index',  [
            'title' => 'Data Penghargaan',
            'jenisKlasifikasi' => $jenisKlasifikasi
        ], compact('penghargaans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = KlasifikasiPenghargaan::all();
        return view('dashboard.penghargaan.create', [
            'title' => 'Tambah Data Baru',
            'jenis' => $jenis,
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
            'keterangan' => 'max:255',
        ];

        $requestData = $request->all();

        foreach (KlasifikasiPenghargaan::all() as $klasifikasi) {
            if ($request->jenis == $klasifikasi->jenis) {
                $requestData['poin'] = $klasifikasi->poin;
                $requestData['klasifikasi_id'] = $klasifikasi->id;
                $rules['poin'] = 'required';
                $rules['klasifikasi_id'] = 'required';
            }
        }

        // dd($requestData);
        $request->merge(['poin' => $requestData['poin']]);
        $request->merge(['klasifikasi_id' => $requestData['klasifikasi_id']]);
        // return $request->all();

        $validatedData = $request->validate($rules);

        Penghargaan::create($validatedData);
        $title = $validatedData['nama'];
        toastr()->success("Data Penghargaan baru berhasil <strong>ditambahkan</strong>!");
        return redirect(route('penghargaan.index'));
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
        // dd($request->tingkatan);
        $rules = [
            'nama' => 'required',
            'keterangan' => 'max:255',
        ];

        $requestData = $request->all();

        foreach (KlasifikasiPenghargaan::all() as $klasifikasi) {
            if ($klasifikasi->tingkatan == request('tingkatan')) {
                // dd($request->tingkatan == $klasifikasi->tingkatan);
                // dd('sama');
                $requestData['poin'] = $klasifikasi->poin;
                $requestData['klasifikasi_id'] = $klasifikasi->id;
                $rules['poin'] = 'required';
                $rules['klasifikasi_id'] = 'required';
            }
        }


        $request->merge(['poin' => $requestData['poin']]);
        $request->merge(['klasifikasi_id' => $requestData['klasifikasi_id']]);
        // return $request->all();

        $validatedData = $request->validate($rules);

        Penghargaan::where('id', $penghargaan->id)->update($validatedData);
        $title = $penghargaan->nama;
        toastr()->success("Data penghargaan <strong>$title</strong> berhasil <strong>diubah</strong>!");
        return redirect(route('penghargaan.index'));
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
        toastr()->success("Data Penghargaan <strong>$title</strong> berhasil <strong>dihapus</strong>!");
        return redirect(route('penghargaan.index'));
    }
}
