<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_title' => fake()->word(),
            'book_description' => fake()->realText(500),
            'book_genre' => fake()->word(),
            'book_author' => fake()->name(),
            'book_format' => fake()->file(),
            'book_url' => fake()->url(),
            'display_image' => fake()->url(),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
