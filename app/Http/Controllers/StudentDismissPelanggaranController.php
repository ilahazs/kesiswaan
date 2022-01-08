<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentDismissPelanggaranController extends Controller
{
    public function dismiss(Student $student)
    {
        $pelanggarans = Pelanggaran::orderBy('updated_at', 'desc')->get();

        return view('dashboard.pelanggaran.input-pelanggaran.dismiss', [
            'title' => 'Ubah Pelanggaran Siswa',
            'student_pelanggarans' => $student->pelanggarans,
        ], compact('student', 'pelanggarans'));
    }

    public function dismissdata(Request $request, Student $student)
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
                    $student->poin_pelanggaran += $p->poin;
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
}
