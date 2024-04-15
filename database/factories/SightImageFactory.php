<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sight;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SightImage>
 */
class SightImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $filepath = public_path('images/sights');
        if (!File::exists($filepath)) {
            File::makeDirectory($filepath);
        }
        return [
            'filename' => fake()->image($filepath, 780, 520, null, false),
        ];
    }
}
