<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $body = collect($this->faker->paragraphs(mt_rand(3, 6)))
            ->map(fn ($p) => "<p>$p</p>")
            ->implode('');

        $excerpt = Str::limit($body, 150, ' ...');

        return [
            'title' => $this->faker->sentence(mt_rand(2, 8)),
            'slug' => $this->faker->slug(),
            // 'body' => '<p>' . implode('</p><p>') . $this->faker->paragraphs(mt_rand(3, 6)) . '</p>',
            'body' => $body,
            'excerpt' => $excerpt,
            'category_id' => random_int(1, 3),
            'user_id' => random_int(2, 4)
        ];
    }
}
