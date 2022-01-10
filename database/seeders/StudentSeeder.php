<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'nama' => 'Admin',
            'nis' => '1920000000',
            'class_id' => 1,
            'jenis_kelamin' => 'L',
            // 'point' => 0,
        ]);

        Student::create([
            'nama' => 'Agus',
            'nis' => '192011010',
            'class_id' => 2,
            'jenis_kelamin' => 'L',
        ]);

        Student::create([
            'nama' => 'Budi',
            'nis' => '192011011',
            'class_id' => 2,
            'jenis_kelamin' => 'L',
        ]);

        Student::create([
            'nama' => 'Dewi',
            'nis' => '192011012',
            'class_id' => 3,
            'jenis_kelamin' => 'L',
        ]);

        Student::create([
            'nama' => 'Murni',
            'nis' => '192011013',
            'class_id' => 3,
            'jenis_kelamin' => 'L',
        ]);

        Student::create([
            'nama' => 'Siswa Hebat',
            'nis' => '192011014',
            'class_id' => 4,
            'jenis_kelamin' => 'L',
            'user_id' => '3'
        ]);

        Student::create([
            'nama' => 'Ilham',
            'nis' => '1920118111',
            'class_id' => 5,
            'jenis_kelamin' => 'L',
            'user_id' => '4'
        ]);
    }
}
