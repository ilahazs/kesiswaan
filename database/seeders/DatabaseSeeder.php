<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // PostSeeder::class,
            UserSeeder::class,
            StudentSeeder::class,
            KelasSeeder::class,
            TeacherSeeder::class,
            PelanggaranSeeder::class,
            KlasifikasiPelanggaranSeeder::class,
            PenghargaanSeeder::class,
            KlasifikasiPenghargaanSeeder::class,
        ]);
        // User::factory(3)->create();
        Student::factory(100)->create();
        // Student::find(2)->pelanggarans()->attach([1, 2, 3]);
    }
}
