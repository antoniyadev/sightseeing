<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sight;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkingHour>
 */
class WorkingHourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $from = fake()->dateTimeBetween('06:00', '22:00')->format('H:00');
        $to = fake()->dateTimeBetween(Carbon::parse($from)->addHour(), Carbon::parse($from)->addHours(4),)->format('H:00');
        return [
            'weekday' => fake()->unique(true)->numberBetween(1, 7),
            'from' => $from,
            'to' => $to,
        ];
    }
}
