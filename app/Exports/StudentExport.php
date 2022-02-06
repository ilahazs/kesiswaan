<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;


class StudentExport implements FromCollection, WithHeadings, WithCustomStartCell, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Student::all();
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function headings(): array
    {
        return ["ID", "CLASS_ID", "NAMA", "NIS", "JENIS_KELAMIN", "POIN_PELANGGARAN", "POIN_PENGHARGAAN", "USER_ID", "CREATED_AT", "UPDATED_AT"];
    }
}
