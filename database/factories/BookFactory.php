<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Genre;
use App\Models\Publisher;
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
    public function definition()
    {
        return [
            'name' => fake()->sentence(3),
            'author_id' => Author::factory(),
            'publisher_id' => Publisher::factory(),
            'genre_id' => Genre::factory(),
        ];
    }
}
