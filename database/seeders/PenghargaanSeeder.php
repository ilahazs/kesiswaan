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
            'nama' => 'Ranking 1',
            'klasifikasi_id' => 1,
        ]);

        Penghargaan::create([
            'nama' => 'Juara LKS',
            'klasifikasi_id' => 2,
        ]);

        Penghargaan::create([
            'nama' => 'Berpartisipasi Kelombaan',
            'klasifikasi_id' => 1,
        ]);

        Penghargaan::create([
            'nama' => 'Juara Hackathon Nasional',
            'klasifikasi_id' => 3,
        ]);
    }
}
