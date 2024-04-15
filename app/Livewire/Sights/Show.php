<?php

namespace App\Livewire\Sights;

use Livewire\Component;
use App\Models\Sight;

class Show extends Component
{
    public Sight $sight;
    public function render()
    {
        return view('livewire.sights.show');
    }
}
