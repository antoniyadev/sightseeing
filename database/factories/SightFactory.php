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
            // 'latitude' => fake()->latitude(),
            // 'longitude' => fake()->longitude(),
            // 'city' => fake()->city(),
            // 'address_postcode' => fake()->postcode(),
            // 'address_street' => fake()->streetAddress(),
            'city' => 'Sofia',
            'country' => 'Bulgaria',
            'address_postcode' => '1421',
            'address_street' => 'Dobar Yunak 13',
            'category_id' => Category::factory()
        ];
    }
}
