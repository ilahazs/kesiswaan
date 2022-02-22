<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentPelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggarans = Pelanggaran::orderBy('updated_at', 'desc')->get();
        $students = Student::orderBy('updated_at', 'desc')->get();

        return view('dashboard.pelanggaran.input-pelanggaran.index',  [
            'title' => 'Data Pelanggaran
            Siswa',
        ], compact('pelanggarans', 'students'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $pelanggarans = Pelanggaran::orderBy('updated_at', 'desc')->get();

        return view('dashboard.pelanggaran.input-pelanggaran.edit', [
            'title' => 'Tambah Pelanggaran Siswa',
            'student_pelanggarans' => $student->pelanggarans,
        ], compact('student', 'pelanggarans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        // dd($request->all());
        // $pelanggaranDapat = Pelanggaran::where('id', $request->pelanggaran[0])->get();
        // foreach ($pelanggaranDapat as $p) {
        //     dd($p->poin);
        // }

        // dd($request->pelanggaran);

        $student->pelanggarans()->attach($request->pelanggaran);
        // foreach ($request->pelanggaran as $pelanggaranBaru) {
        //     // $dummyP = Pelanggaran::where('id', $pelanggaranBaru)->get('poin');
        //     // dd(Pelanggaran::where('id', $pelanggaranBaru)->get('poin'));
        //     $student->poin_pelanggaran = Pelanggaran::where('id', $pelanggaranBaru)->get('poin')->poin;
        // }
        for ($i = 0; $i < count($request->pelanggaran); $i++) {
            $pelanggaranDapat = Pelanggaran::where('id', $request->pelanggaran[$i])->get();
            foreach ($pelanggaranDapat as $p) {
                $student->poin_pelanggaran += $p->poin;
            }
        }
        $student->save();
        // Student::where('id', $student->id)->update($student);
        $title = $student->nama;
        return redirect(route('pelanggaran.students.index'))->with('success', "Data Siswa <strong>$title</strong> berhasil <strong>diubah</strong>!");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
