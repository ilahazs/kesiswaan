<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::create([
            'nama' => 'Windah Basudara',
            // 'class_id' => 18,
            'nip' => '1920110999',
            'user_id' => 5,
        ]);
    }
}
