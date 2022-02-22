<?php

namespace Database\Seeders;

use App\Models\KlasifikasiPenghargaan;
use Illuminate\Database\Seeder;

class KlasifikasiPenghargaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KlasifikasiPenghargaan::create([
            'tingkatan' => 'Sekolah',
            'poin' => 30
        ]);
        KlasifikasiPenghargaan::create([
            'tingkatan' => 'Universitas',
            'poin' => 40
        ]);
        KlasifikasiPenghargaan::create([
            'tingkatan' => 'Kabupaten/Kota',
            'poin' => 50
        ]);
        KlasifikasiPenghargaan::create([
            'tingkatan' => 'Nasional',
            'poin' => 100
        ]);
    }
}
