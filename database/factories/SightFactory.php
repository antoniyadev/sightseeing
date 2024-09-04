<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\City;
use Illuminate\Support\Facades\File;

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
        $city = City::factory()->create();

        $filepath = public_path('images/sights');
        if (!File::exists($filepath)) {
            File::makeDirectory($filepath);
        }
        return [
            'title' => fake()->words(3, true),
            'description' => fake()->paragraphs(3, true),
            'images' => fake()->image($filepath, 780, 520, null, false),
            'price' => fake()->numberBetween(1, 100),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'address_postcode' => fake()->postcode(),
            'address_street' => fake()->streetAddress(),
            'city_id' => $city->id,
            'category_id' => Category::factory()
        ];
    }
}
