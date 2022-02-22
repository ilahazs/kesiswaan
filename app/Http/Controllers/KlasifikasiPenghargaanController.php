<?php

namespace App\Http\Controllers;

use App\Models\KlasifikasiPenghargaan;
use App\Http\Requests\StoreKlasifikasiPenghargaanRequest;
use App\Http\Requests\UpdateKlasifikasiPenghargaanRequest;
use Illuminate\Http\Request;


class KlasifikasiPenghargaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.penghargaan.klasifikasi', [
            'title' => 'Klasifikasi Penghargaan',
            'klasifikasi' => KlasifikasiPenghargaan::orderBy('updated_at', 'desc')->get()
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
     * @param  \App\Http\Requests\StoreKlasifikasiPenghargaanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tingkatan' => 'required',
            'poin' => 'required',
        ]);

        KlasifikasiPenghargaan::create($validated);

        $title = $request->nama;
        toastr()->success("Data Klasifikasi baru berhasil <strong>ditambahkan</strong>!");
        return redirect(route('klasifikasi-penghargaan.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KlasifikasiPenghargaan  $klasifikasiPenghargaan
     * @return \Illuminate\Http\Response
     */
    public function show(KlasifikasiPenghargaan $klasifikasiPenghargaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KlasifikasiPenghargaan  $klasifikasiPenghargaan
     * @return \Illuminate\Http\Response
     */
    public function edit(KlasifikasiPenghargaan $klasifikasiPenghargaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKlasifikasiPenghargaanRequest  $request
     * @param  \App\Models\KlasifikasiPenghargaan  $klasifikasiPenghargaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  KlasifikasiPenghargaan $klasifikasiPenghargaan)
    {
        $validated = $request->validate([
            'tingkatan' => 'required',
            'poin' => 'required',
        ]);

        KlasifikasiPenghargaan::where('id', $klasifikasiPenghargaan->id)->update($validated);

        $title = $klasifikasiPenghargaan->tingkatan;
        toastr()->success("Data Klasifikasi <strong>$title</strong> berhasil <strong>diubah</strong>!");
        return redirect(route('klasifikasi-penghargaan.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KlasifikasiPenghargaan  $klasifikasiPenghargaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KlasifikasiPenghargaan $klasifikasiPenghargaan)
    {
        $title = $klasifikasiPenghargaan->tingkatan;
        KlasifikasiPenghargaan::destroy($klasifikasiPenghargaan->id);
        // toastr()->error('Error Message');
        // toastr()->info('Info Message');
        // toastr()->warning('<Wa></Wa>a></Wa>rning Message');
        toastr()->success("Data Klasifikasi <strong>$title</strong> berhasil <strong>dihapus</strong>!");
        return redirect(route('klasifikasi-pelanggaran.index'));
    }
}
