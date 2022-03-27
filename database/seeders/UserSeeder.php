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
        // For user has role admin
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin'),
        ]);
        User::create([
            'name' => 'KS01',
            'username' => 'ks01',
            'email' => 'ks01@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin'),
        ]);
        User::create([
            'name' => 'BK01',
            'username' => 'bk01',
            'email' => 'bk01@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        User::create([
            'name' => 'BK02',
            'username' => 'bk02',
            'email' => 'bk02@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        // For user has role teacher
        User::create([
            'name' => 'WK01',
            'username' => 'wk01',
            'role' => 'guru',
            'email' => 'wk01@gmail.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'WK02',
            'username' => 'wk02',
            'email' => 'wk02@gmail.com',
            'role' => 'guru',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'WK03',
            'username' => 'wk03',
            'email' => 'wk03@gmail.com',
            'role' => 'guru',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Windah Basudara',
            'username' => '1920110999',
            'email' => '1920110999@gmail.com',
            'role' => 'guru',
            'password' => Hash::make('1920110999')
        ]);
    }
}
