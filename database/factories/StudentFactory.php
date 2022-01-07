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
            'class_id' => mt_rand(1, 9),
            'rule_data_id' => mt_rand(1, 5),
            'nama' => $this->faker->name(),
            'nis' => $this->faker->unique()->bothify('1920118###'),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'point' => mt_rand(20, 100),
        ];
    }
}
