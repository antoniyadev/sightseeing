<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->country,
            'iso2' => fake()->countryCode,
            'iso3' => fake()->countryISOAlpha3,
            'phone_code' => fake()->randomNumber(3),
            'region' => fake()->city(),
            'subregion' => fake()->city(),
        ];
    }
}
