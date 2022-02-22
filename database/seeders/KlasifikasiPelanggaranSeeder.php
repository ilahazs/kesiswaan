<?php

namespace Database\Seeders;

use App\Models\KlasifikasiPelanggaran;
use Illuminate\Database\Seeder;

class KlasifikasiPelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KlasifikasiPelanggaran::create([
            'jenis' => 'ringan',
            'poin' => 30
        ]);
        KlasifikasiPelanggaran::create([
            'jenis' => 'sedang',
            'poin' => 50
        ]);
        KlasifikasiPelanggaran::create([
            'jenis' => 'berat',
            'poin' => 100
        ]);
    }
}
