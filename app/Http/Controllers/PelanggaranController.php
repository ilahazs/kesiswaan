<?php

namespace App\Http\Controllers;

use App\Models\KlasifikasiPelanggaran;
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
        // $jenis = ['ringan', 'sedang', 'berat'];
        // $jenis = KlasifikasiPelanggaran::pluck('jenis')->toArray();
        // $jenis = KlasifikasiPelanggaran::get('jenis')->toArray();
        $jenisKlasifikasi = KlasifikasiPelanggaran::get();
        // dd($jenisKlasifikasi);

        return view('dashboard.pelanggaran.index',  [
            'title' => 'Data Pelanggaran',
            'jenisKlasifikasi' => $jenisKlasifikasi
        ], compact('pelanggarans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $jenis = ['ringan', 'sedang', 'berat'];
        $jenis = KlasifikasiPelanggaran::all();
        // dd($jenis);



        return view('dashboard.pelanggaran.create', [
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

        foreach (KlasifikasiPelanggaran::all() as $klasifikasi) {
            if ($request->jenis == $klasifikasi->jenis) {
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
        // dd($request->all());

        // $validatedData = $request->validate([
        //     'nama' => 'required',
        //     'jenis' => 'required',
        //     'keterangan' => 'max:255',
        // ]);

        $rules = [
            'nama' => 'required',
            'keterangan' => 'max:255',
        ];

        $requestData = $request->all();

        foreach (KlasifikasiPelanggaran::all() as $klasifikasi) {
            if ($request->jenis == $klasifikasi->jenis) {
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

        Pelanggaran::where('id', $pelanggaran->id)->update($validatedData);
        $title = $pelanggaran->nama;
        toastr()->success("Data pelanggaran <strong>$title</strong> berhasil <strong>diubah</strong>!");
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
w
