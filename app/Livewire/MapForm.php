<?php

namespace App\Livewire;

use Livewire\Component;

class MapForm extends Component
{
    public $searchKey;
    public $filterId;
    public $coords;

    public function submit()
    {
        // Validate entries
        $this->validate([
            'searchKey' => 'string',
            'filterId'  => 'numeric',
            'coords'    => 'required',
        ]);

        // Do processing

        // Redirect 
    }

    public function render()
    {
        return view('livewire.map-form');
    }
}
