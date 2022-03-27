<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Penghargaan;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentDismissPelanggaranController extends Controller
{
    public function dismisspelanggaranview(Student $student)
    {
        $pelanggarans = Pelanggaran::orderBy('updated_at', 'desc')->get();
        // dd(Student::all()->pelanggarans('student_id', '!=', null)->get());

        return view('dashboard.pelanggaran.input-pelanggaran.dismiss', [
            'title' => 'Ubah Pelanggaran Siswa',
            'student_pelanggarans' => $student->pelanggarans,
        ], compact('student', 'pelanggarans'));
    }

    public function dismisspelanggarandata(Request $request, Student $student)
    {
        // dd($request->pelanggaran);
        // dd($request->pelanggaran == null);
        // dd(count(array_filter($request->pelanggaran)));
        $student->pelanggarans()->detach();
        $student->poin_pelanggaran = 0;

        $student->pelanggarans()->attach($request->pelanggaran);
        if ($request->pelanggaran != null) {
            for ($i = 0; $i < count($request->pelanggaran); $i++) {
                $pelanggaranDapat = Pelanggaran::where('id', $request->pelanggaran[$i])->get();
                foreach ($pelanggaranDapat as $p) {
                    $student->poin_pelanggaran += $p->klasifikasi->poin;
                    if ($student->poin_pelanggaran < 0) {
                        $student->poin_pelanggaran = 0;
                    }
                }
            }
        }

        $student->save();

        $title = $student->nama;
        return redirect(route('pelanggaran.students.index'))->with('success', "Data Siswa <strong>$title</strong> berhasil <strong>diubah</strong>!");
    }
    public function dismisspenghargaanview(Student $student)
    {
        $penghargaans = Penghargaan::orderBy('updated_at', 'desc')->get();
        // dd(Student::all()->penghargaans('student_id', '!=', null)->get());

        return view('dashboard.penghargaan.input-penghargaan.dismiss', [
            'title' => 'Ubah Penghargaan Siswa',
            'student_penghargaans' => $student->penghargaans,
        ], compact('student', 'penghargaans'));
    }

    public function dismisspenghargaandata(Request $request, Student $student)
    {
        // dd($request->pelanggaran);
        // dd($request->pelanggaran == null);
        // dd(count(array_filter($request->pelanggaran)));
        $student->penghargaans()->detach();
        $student->poin_penghargaan = 0;

        $student->penghargaans()->attach($request->penghargaan);
        if ($request->penghargaan != null) {
            for ($i = 0; $i < count($request->penghargaan); $i++) {
                $penghargaanDapat = Pelanggaran::where('id', $request->penghargaan[$i])->get();
                foreach ($penghargaanDapat as $p) {
                    $student->poin_penghargaan += $p->klasifikasi->poin;
                    if ($student->poin_penghargaan < 0) {
                        $student->poin_penghargaan = 0;
                    }
                }
            }
        }

        $student->save();

        $title = $student->nama;
        return redirect(route('penghargaan.students.index'))->with('success', "Data Siswa <strong>$title</strong> berhasil <strong>diubah</strong>!");
    }
}
