<?php

namespace App\Http\Controllers;

use App\Models\KlasifikasiPelanggaran;
use App\Http\Requests\StoreKlasifikasiPelanggaranRequest;
use App\Http\Requests\UpdateKlasifikasiPelanggaranRequest;
use Illuminate\Http\Request;



class KlasifikasiPelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pelanggaran.klasifikasi', [
            'title' => 'Klasifikasi Pelanggaran',
            'klasifikasi' => KlasifikasiPelanggaran::orderBy('updated_at', 'desc')->get()
        ]);
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
     * @param  \App\Http\Requests\StoreKlasifikasiPelanggaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required',
            'poin' => 'required',
        ]);

        KlasifikasiPelanggaran::create($validated);

        $title = $request->nama;
        toastr()->success("Data Klasifikasi baru berhasil <strong>ditambahkan</strong>!");
        return redirect(route('klasifikasi-pelanggaran.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KlasifikasiPelanggaran  $klasifikasiPelanggaran
     * @return \Illuminate\Http\Response
     */
    public function show(KlasifikasiPelanggaran $klasifikasiPelanggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KlasifikasiPelanggaran  $klasifikasiPelanggaran
     * @return \Illuminate\Http\Response
     */
    public function edit(KlasifikasiPelanggaran $klasifikasiPelanggaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKlasifikasiPelanggaranRequest  $request
     * @param  \App\Models\KlasifikasiPelanggaran  $klasifikasiPelanggaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KlasifikasiPelanggaran $klasifikasiPelanggaran)
    {
        $validated = $request->validate([
            'jenis' => 'required',
            'poin' => 'required',
        ]);

        KlasifikasiPelanggaran::where('id', $klasifikasiPelanggaran->id)->update($validated);

        $title = $klasifikasiPelanggaran->jenis;
        toastr()->success("Data Klasifikasi <strong>$title</strong> berhasil <strong>diubah</strong>!");
        return redirect(route('klasifikasi-pelanggaran.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KlasifikasiPelanggaran  $klasifikasiPelanggaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(KlasifikasiPelanggaran $klasifikasiPelanggaran)
    {
        $title = $klasifikasiPelanggaran->jenis;
        KlasifikasiPelanggaran::destroy($klasifikasiPelanggaran->id);
        // toastr()->error('Error Message');
        // toastr()->info('Info Message');
        // toastr()->warning('<Wa></Wa>a></Wa>rning Message');
        toastr()->success("Data Klasifikasi <strong>$title</strong> berhasil <strong>dihapus</strong>!");
        return redirect(route('klasifikasi-pelanggaran.index'));
    }
}
