<?php

namespace Database\Seeders;

use App\Models\RuleData;
use Illuminate\Database\Seeder;

class RuleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RuleData::create([
            'data_type' => '0', // 0: pelanggaran || 1: penghargaan
            'keterangan' => 'Telat masuk sekolah',
            'jenis' => 'rendah',
            'point' => 30,
        ]);
        RuleData::create([
            'data_type' => '0', // 0: pelanggaran || 1: penghargaan
            'keterangan' => 'Tidak hadir selama 1 semester',
            'jenis' => 'tinggi',
            'point' => 90,
        ]);
        RuleData::create([
            'data_type' => '0', // 0: pelanggaran || 1: penghargaan
            'keterangan' => 'Berkelahi sesama teman',
            'jenis' => 'sedang',
            'point' => 40,
        ]);
        RuleData::create([
            'data_type' => '1', // 0: pelanggaran || 1: penghargaan
            'keterangan' => 'Kerapihan dan kelengkapan atribut',
            'jenis' => 'rendah',
            'point' => 30,
        ]);
        RuleData::create([
            'data_type' => '1', // 0: pelanggaran || 1: penghargaan
            'keterangan' => 'Memenangkan lomba LKS',
            'jenis' => 'tinggi',
            'point' => 30,
        ]);
    }
}
