<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sight>
 */
class SightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'description' => fake()->paragraphs(3, true),
            'price' => fake()->numberBetween(1, 100),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'category_id' => Category::factory()
        ];
    }
}
