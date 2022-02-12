<?php

namespace Database\Seeders;

use App\Models\Penghargaan;
use Illuminate\Database\Seeder;

class PenghargaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Penghargaan::create([
            'nama' => 'Disiplin',
            'tingkatan' => 'Sekolah',
            'poin' => 20
        ]);

        Penghargaan::create([
            'nama' => 'Juara LKS',
            'tingkatan' => 'Sekolah',
            'poin' => 50
        ]);

        Penghargaan::create([
            'nama' => 'Ranking 1 Kelas',
            'tingkatan' => 'Sekolah',
            'poin' => 50
        ]);

        Penghargaan::create([
            'nama' => 'Melaksanakan piket',
            'tingkatan' => 'Sekolah',
            'poin' => 20
        ]);
    }
}
