<?php

namespace App\Http\Controllers;

use App\Exports\StudentKelasExport;
use App\Models\Kelas;
use App\Models\Teacher;
use Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TeacherController extends Controller
{
    public function export_students_kelas()
    {
        $k = '';
        $guru = '';
        foreach (Teacher::all() as $teacher) {
            if ($teacher->user_id == Auth::user()->id) {
                $guru = $teacher;
            }
        }
        foreach (Kelas::all() as $kelas) {
            if ($kelas->teacher_id != null && $kelas->teacher_id == $guru->id) {
                $k = $kelas;
            }
        }

        $romawiTingkatan = '';
        switch ($k->tingkatan) {
            case '10':
                $romawiTingkatan = 'X';
                break;
            case '11':
                $romawiTingkatan = 'XI';
                break;
            case '12':
                $romawiTingkatan = 'XII';
                break;
            default:
                $romawiTingkatan = 'None';
                break;
        }

        $concatKelas = $romawiTingkatan . ' ' . $k->jurusan . ' ' . $k->nama;

        $filename = "students-kelas-" . $concatKelas . "-export-" . date("Y-m-d H:i:s") . ".csv";
        return Excel::download(new StudentKelasExport,  $filename, null, ["ID", "CLASS_ID", "NAMA", "NIS", "JENIS_KELAMIN", "NO_TELP", "POIN_PELANGGARAN", "POIN_PENGHARGAAN", "USER_ID", "CREATED_AT", "UPDATED_AT"]);
    }
}
