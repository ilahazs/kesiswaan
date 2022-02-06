<?php

namespace App\Http\Controllers;

use App\Models\Penghargaan;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentPenghargaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggarans = Penghargaan::orderBy('updated_at', 'desc')->get();
        $students = Student::orderBy('updated_at', 'desc')->get();

        return view('dashboard.penghargaan.input-penghargaan.index',  [
            'title' => 'Kelola Data Penghargaan',
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
        $penghargaans = Penghargaan::orderBy('updated_at', 'desc')->get();

        return view('dashboard.penghargaan.input-penghargaan.edit', [
            'title' => 'Tambah Penghargaan Siswa',
            'student_penghargaans' => $student->penghargaans,
        ], compact('student', 'penghargaans'));
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
        $student->penghargaans()->attach($request->penghargaan);
        // foreach ($request->penghargaan as $penghargaanBaru) {
        //     // $dummyP = penghargaan::where('id', $penghargaanBaru)->get('poin');
        //     // dd(penghargaan::where('id', $penghargaanBaru)->get('poin'));
        //     $student->poin_penghargaan = penghargaan::where('id', $penghargaanBaru)->get('poin')->poin;
        // }
        for ($i = 0; $i < count($request->penghargaan); $i++) {
            $penghargaanDapat = Penghargaan::where('id', $request->penghargaan[$i])->get();
            foreach ($penghargaanDapat as $p) {
                $student->poin_penghargaan += $p->poin;
            }
        }
        $student->save();
        // Student::where('id', $student->id)->update($student);
        $title = $student->nama;
        return redirect(route('penghargaan.students.index'))->with('success', "Data Siswa <strong>$title</strong> berhasil <strong>diubah</strong>!");
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
