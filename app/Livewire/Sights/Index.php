<?php

namespace App\Livewire\Sights;

use Livewire\Component;
use App\Models\Sight as SightModel;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public Collection $categories;

    public $searchCategory = 0;
    public $searchText = '';

    public $minPrice = '';
    public $maxPrice = '';
    public function mount(): void
    {
        $this->categories = Category::pluck('title', 'id');
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
        $sights = SightModel::when($this->searchCategory > 0, fn (Builder $query) => $query->where('category_id', $this->searchCategory))
            ->when($this->searchText != "", fn (Builder $query) => $query->where(function ($query) {
                $query->where('title', 'like', '%' . $this->searchText . '%')
                    ->orWhere('description', 'like', '%' . $this->searchText . '%');
            }))
            ->when($this->minPrice != '', fn (Builder $query) => $query->where('price', '>=', $this->minPrice))
            ->when($this->maxPrice, fn (Builder $query) => $query->where('price', '<=', $this->maxPrice))
            ->paginate(10);
        return view('livewire.sights.index', ['sights' => $sights]);
    }
}