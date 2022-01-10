<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'gender' => 'L',
            'role' => 'admin',
            'password' => Hash::make('admin'),
        ]);
        User::create([
            'name' => 'Guru Bijak',
            'username' => 'guru',
            'gender' => 'L',
            'role' => 'guru',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Siswa hebat',
            'username' => 'siswa',
            'gender' => 'P',
            'role' => 'siswa',
            'email' => 'siswa@gmail.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Ilham Prabu Zaky S',
            'username' => 'ilhamprabuzakys',
            'gender' => 'L',
            'role' => 'siswa',
            'email' => '1920118111@gmail.com',
            'password' => Hash::make('password')
        ]);
        // User::create([
        //     'name' => 'Pengguna 3',
        //     'username' => 'pengguna3',
        //     'gender' => 'L',
        //     'email' => 'pengguna3@gmail.com',
        //     'password' => Hash::make('password')
        // ]);
    }
}
