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
            // 'poin' => 50
            'klasifikasi_id' => 1,
        ]);

        Pelanggaran::create([
            'nama' => 'Pemalsuan izin/surat',
            // 'poin' => 50
            'klasifikasi_id' => 3,
        ]);

        Pelanggaran::create([
            'nama' => 'Berkelahi',
            // 'poin' => 50
            'klasifikasi_id' => 2,
        ]);

        Pelanggaran::create([
            'nama' => 'Mencontek/curang dalam ujian',
            // 'poin' => 20
            'klasifikasi_id' => 1,
        ]);

        Pelanggaran::create([
            'nama' => 'Membuat masalah dengan guru',
            // 'poin' => 30
            'klasifikasi_id' => 1,
        ]);

        Pelanggaran::create([
            'nama' => 'Kabur dari sekolah',
            // 'poin' => 30
            'klasifikasi_id' => 2,
        ]);


        Pelanggaran::create([
            'nama' => 'Terlambat',
            // 'poin' => 20
            'klasifikasi_id' => 1,
        ]);

        Pelanggaran::create([
            'nama' => 'Membawa kendaraan dan belum cukup umur',
            // 'poin' => 20
            'klasifikasi_id' => 1,
        ]);
    }
}
