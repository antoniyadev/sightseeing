<?php

namespace App\Livewire\Sights;

use App\Facades\Cart;
use Livewire\Component;
use App\Models\Sight;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public Collection $categories;
    public Collection $locations;

    public $searchCategory = 0;
    public $searchLocation = '';
    public $searchText = '';

    // public $minPrice = '';
    public $maxPrice = 250;

    public function mount(): void
    {
        $this->categories = Category::pluck('title', 'id');
        $this->locations = $this->getLocations();
    }

    private function getLocations()
    {
        return Sight::join('cities', 'sights.city_id', '=', 'cities.id')->get()->pluck('name', 'id');
    }

    //fix bug with live searches not working on second paginations
    public function updating($key): void
    {
        if ($key === 'searchCategory' || $key === 'searchText') {
            $this->resetPage();
        }
    }
    public function render()
    {
        $sights = Sight::when($this->searchCategory > 0, fn (Builder $query) => $query->where('category_id', $this->searchCategory))
            ->when($this->searchText != "", fn (Builder $query) => $query->where(function ($query) {
                $query->where('title', 'like', '%' . $this->searchText . '%')
                    ->orWhere('description', 'like', '%' . $this->searchText . '%');
            }))
            // ->when($this->minPrice != '', fn (Builder $query) => $query->where('price', '>=', $this->minPrice))
            ->when($this->maxPrice, fn (Builder $query) => $query->where('price', '<=', $this->maxPrice))
            ->when($this->searchLocation, fn (Builder $query) => $query->where('city_id', '=', $this->searchLocation))
            ->paginate(9);
        return view('livewire.sights.index', ['sights' => $sights]);
    }

    public function addToCart(int $sightId, $quantity = 1): void
    {
        if (auth()->guest()) {
            redirect()->guest('login');
            return;
        }
        Cart::add(Sight::where('id', $sightId)->first(), $quantity);
        $this->dispatch('cart-updated', quantity: $quantity, message: "Ticket added to cart!");
    }

    public function paginationView()
    {
        return 'custom-pagination-links-view';
    }
}