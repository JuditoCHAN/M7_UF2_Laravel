<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ratings = ['G', 'PG', 'PG-13', 'R', 'NC-17'];
        $genres = ['thriller', 'action', 'drama', 'love'];

        return [
            'name' => $this->faker->sentence(3),
            'year' => $this->faker->year,
            'genre' => $this->faker->randomElement($genres),
            'country' => $this->faker->country,
            'rating' => $this->faker->randomElement($ratings),
            'duration' => $this->faker->numberBetween(90, 180),
            'img_url' => $this->faker->imageUrl(640, 480, 'movies')
        ];
    }
}
