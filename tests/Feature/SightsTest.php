<?php

namespace Tests\Feature;

use App\Models\Sight;
use Filament\Notifications\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SightsTest extends TestCase
{
    use RefreshDatabase;
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
        $sight = Sight::factory()->create();
        $response = $this->get('/sights');

        $response
            ->assertStatus(200)
            ->assertDontSee('No sights found')
            ->assertViewHas('sights', function (Collection $collection) use ($sight) {
            return $collection->contains($sight);
        });
    }
}
