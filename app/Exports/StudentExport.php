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
        return ["NO", "ID", "NAMA", "NIS", "JENIS_KELAMIN", "PELANGGARAN", "PENGHARGAAN", "CREATED_AT", "UPDATED_AT"];
    }

    // public function columnWidths(): array
    // {
    //     return [
    //         'A' => 100,
    //         'B' => 200,
    //         'C' => 55,
    //         'D' => 45,
    //         'E' => 55,
    //         'F' => 45,
    //         'G' => 55,
    //         'H' => 45,
    //     ];
    // }

}
