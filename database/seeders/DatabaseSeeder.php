<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sight;
use App\Models\WorkingHour;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Sight::factory(5)->create();

        // Sight::all()->each(function (Sight $sight) {
        // create random working hours for workdays from 1 to 7 
        // $workingHours = WorkingHour::factory()->count(random_int(1, 7))->make();
        // $sight->workingHours()->saveMany($workingHours);
        // });
    }
}
