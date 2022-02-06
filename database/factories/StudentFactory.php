<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'class_id' => mt_rand(1, 54),
            'nama' => $this->faker->name(),
            'nis' => $this->faker->unique()->bothify('192011####'),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'poin_penghargaan' => 0,
            'poin_penghargaan' => 0,
        ];
    }
}
