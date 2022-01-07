<?php

namespace App\Http\Controllers;

use App\Models\RuleData;
use Illuminate\Http\Request;

class RuleDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aturanPenghargaan = RuleData::orderBy('updated_at', 'desc')->where('data_type', 1)->get();
        $aturanPelanggaran = RuleData::orderBy('updated_at', 'desc')->where('data_type', 0)->get();

        // return $aturanPelanggaran;

        return view('dashboard.rules.index', [
            'title' => 'Rule Data',
            'rulesData' => RuleData::orderBy('updated_at', 'desc')->get(),
            'aturanPenghargaan' => $aturanPenghargaan,
            'aturanPelanggaran' => $aturanPelanggaran,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_type = [0, 1];
        $jenis = ['rendah', 'sedang', 'tinggi'];

        return view('dashboard.rules.create', [
            'title' => 'Create New Rule',
            'data_type' => $data_type,
            'jenis' => $jenis,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'data_type' => 'required',
            'keterangan' => 'required',
            'jenis' => 'required',
        ];
        $requestData = $request->all();

        if ($request->jenis == 'rendah') {
            $requestData['point'] = 30;
            $rules['point'] = 'required';
        } elseif ($request->jenis == 'sedang') {
            $requestData['point'] = 40;
            $rules['point'] = 'required';
        } elseif ($request->jenis == 'tinggi') {
            $requestData['point'] = 50;
            $rules['point'] = 'required';
        }


        $request->merge(['point' => $requestData['point']]);
        // return $request->all();

        $validatedData = $request->validate($rules);

        RuleData::create($validatedData);
        $title = $validatedData['keterangan'];

        return redirect(route('dashboard.ruledata.index'))->with('success', "Data Aturan Baru: <strong>$title</strong> berhasil <strong>ditambahkan</strong>!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RuleData  $ruleData
     * @return \Illuminate\Http\Response
     */
    public function show(RuleData $ruleData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RuleData  $ruleData
     * @return \Illuminate\Http\Response
     */
    public function edit(RuleData $ruledatum)
    {
        $data_type = [0, 1];
        $jenis = ['rendah', 'sedang', 'tinggi'];

        return view('dashboard.rules.edit', [
            'title' => 'Edit Existing Rule',
            'rule' => $ruledatum,
            'ruledatum' => $ruledatum,
            'ruledatum' => $ruledatum,
            'data_type' => $data_type,
            'jenis' => $jenis,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RuleData  $ruleData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RuleData $ruledatum)
    {
        $validatedData = $request->validate([
            'data_type' => 'required',
            'keterangan' => 'required',
            'jenis' => 'required',
            'point' => 'required',
        ]);

        RuleData::where('id', $ruledatum->id)->update($validatedData);
        $title = $validatedData['keterangan'];

        return redirect(route('dashboard.ruledata.index'))->with('success', "Data Aturan: <strong>$title</strong> berhasil <strong>diubah</strong>!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RuleData  $ruleData
     * @return \Illuminate\Http\Response
     */
    public function destroy(RuleData $ruledatum)
    {
        $title = $ruledatum->keterangan;
        RuleData::destroy($ruledatum->id);

        return redirect(route('dashboard.ruledata.index'))->with('success', "Data Aturan: <strong>$title</strong> berhasil <strong>dihapus</strong>!");
    }
}
