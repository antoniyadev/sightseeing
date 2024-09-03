<?php

namespace App\Livewire;

use Livewire\Component;

class Map extends Component
{
    public $sight;
    public $lat = 42.7249925;
    public $lng = 25.4833039;

    public function mount()
    {
        if (isset($this->sight->latitude) && isset($this->sight->longitude)) {
            $this->lat = $this->sight->latitude;
            $this->lng = $this->sight->longitude;
        }
    }
    public function render()
    {
        return view('livewire.map');
    }
}
