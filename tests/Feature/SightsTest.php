<?php

namespace Tests\Feature;

use App\Livewire\Sights\Index;
use App\Models\City;
use App\Models\Country;
use App\Models\Sight;
use Filament\Notifications\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Livewire;
use Tests\TestCase;

class SightsTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * test_sights_page_contains_empty_table
     */
    public function test_sights_page_contains_empty_table(): void
    {
        $response = $this->get('/sights');

        $response->assertStatus(200);
        $response->assertSee('No sights found');
    }

    public function test_sights_page_contains_table_with_data(): void
    {
        $city = City::factory()->create();
        $sight = Sight::factory()->create(['city_id' => $city->id]);
        $component = Livewire::test(Index::class);

        $component
            ->assertStatus(200)
            ->assertDontSee('No sights found')
            ->assertViewHas('sights', function (LengthAwarePaginator $collection) use ($sight) {
                return $collection->contains($sight);
            });
    }
}