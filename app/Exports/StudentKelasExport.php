<?php

namespace App\Exports;

use App\Models\Kelas;
use App\Models\Student;
use App\Models\Teacher;
use Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class StudentKelasExport implements FromCollection, WithHeadings, WithCustomStartCell, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
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

        return $students;
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function headings(): array
    {
        return ["ID", "CLASS_ID", "NAMA", "NIS", "JENIS_KELAMIN", "NO_TELP", "POIN_PELANGGARAN", "POIN_PENGHARGAAN", "USER_ID", "CREATED_AT", "UPDATED_AT"];
    }
}
