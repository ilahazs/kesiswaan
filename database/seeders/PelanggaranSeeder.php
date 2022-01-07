<?php

namespace Database\Seeders;

use App\Models\Pelanggaran;
use Illuminate\Database\Seeder;

class PelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pelanggaran::create([
            'nama' => 'Mencuri',
            'poin' => 50
        ]);

        Pelanggaran::create([
            'nama' => 'Berkelahi',
            'poin' => 50
        ]);

        Pelanggaran::create([
            'nama' => 'Mencontek',
            'poin' => 30
        ]);

        Pelanggaran::create([
            'nama' => 'Terlambat',
            'poin' => 30
        ]);
    }
}
