<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
        $jmlhUserSiswa = User::where('role', 'siswa')->count();
        $dataUserSiswa = User::where('role', 'siswa')->pluck('id')->toArray();
        // dd(array_rand($dataUserSiswa));
        return [
            'class_id' => mt_rand(1, 54),
            'nama' => $this->faker->name(),
            'nis' => $this->faker->unique()->bothify('192011####'),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'poin_penghargaan' => 0,
            'poin_penghargaan' => 0,
            // 'user_id' => array_rand($dataUserSiswa)
            // 'user_id' => array_rand($dataUserSiswa)
            // 'user_id' => $this->faker->unique(false)->randomDigit($dataUserSiswa)
        ];
    }
}
