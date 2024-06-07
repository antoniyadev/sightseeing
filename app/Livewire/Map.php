<?php

namespace App\Livewire;

use Livewire\Component;

class Map extends Component
{
    public $lat = -25.344;
    public $lng = 131.031;

    public function render()
    {
        return view('livewire.map');
    }
}
