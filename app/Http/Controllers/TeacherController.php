<?php

namespace App\Http\Controllers;

use App\Exports\StudentKelasExport;
use App\Models\Kelas;
use App\Models\Student;
use App\Models\Teacher;
use Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class TeacherController extends Controller
{
    public function index()
    {
        $guru = Teacher::where('user_id', Auth::user()->id)->get()[0];
        $k = Kelas::where('teacher_id', $guru->id)->get()[0];
        dd($guru);

        // foreach (Teacher::all() as $teacher) {
        //     if ($teacher->user_id == Auth::user()->id) {
        //         $guru = $teacher;
        //     }
        // }
        // // dd($guru->nama);
        // foreach (Kelas::all() as $kelas) {
        //     if ($kelas->teacher_id != null && $kelas->teacher_id == $guru->id) {
        //         $k = $kelas;
        //     }
        // }

        return view('dashboard.guru-pages.guru', [
            'title' => 'Data Guru',
            'guru' => $guru,
            'kelas' => $k
        ]);
    }

    public function rekap_kelas()
    {
        $k = '';
        $guru = '';
        foreach (Teacher::all() as $teacher) {
            if ($teacher->user_id == Auth::user()->id) {
                $guru = $teacher;
            }
        }
        // dd($guru->nama);
        foreach (Kelas::all() as $kelas) {
            if ($kelas->teacher_id != null && $kelas->teacher_id == $guru->id) {
                $k = $kelas;
            }
        }

        $students = Student::where('class_id', $k->id)->get();

        // Student::where('id', 7)->update([
        //     'notelp' => '081324086956'
        // ]);

        return view('dashboard.guru-pages.rekap', [
            'title' => 'Data Kelasku',
            'students' => $students,
            // 'pelanggarans' => $pelanggarans,
        ]);
    }

    public function rekap_pdf()
    {
        $k = '';
        $guru = '';
        foreach (Teacher::all() as $teacher) {
            if ($teacher->user_id == Auth::user()->id) {
                $guru = $teacher;
            }
        }
        // dd($guru->nama);
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

        $students = Student::where('class_id', $k->id)->get();
        $details = [
            'students' => $students,
            'title' => 'Rekap Kelas ' . $concatKelas,
            'namaKelas' => $concatKelas,
            'namaWalikelas' => $guru->nama,
        ];

        $pdf = PDF::loadview('dashboard.guru-pages.rekap_pdf', $details);
        return $pdf->download('laporan-kelas-siswa.pdf');
    }

    public function viewrekap_pdf()
    {
        $k = '';
        $guru = '';
        foreach (Teacher::all() as $teacher) {
            if ($teacher->user_id == Auth::user()->id) {
                $guru = $teacher;
            }
        }
        // dd($guru->nama);
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

        $students = Student::where('class_id', $k->id)->get();
        $details = [
            'students' => $students,
            'title' => 'Rekap Kelas ' . $concatKelas,
            'namaKelas' => $concatKelas,
            'namaWalikelas' => $guru->nama,
        ];
        return view('dashboard.guru-pages.rekap_pdf', $details);
    }


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
