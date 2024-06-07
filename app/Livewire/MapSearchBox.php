<?php

namespace App\Livewire;

use Livewire\Component;

class MapSearchBox extends Component
{
    public $address;

    public function search()
    {
        // Use a custom service to get address' lat-long coordinates
        // Either through Google GeoCoder or some other translator
        $coordinates = \GoogleMaps::load('geocoding')
            ->setParam(['address' => $this->address])
            ->get();
        // Dispatch event to the page
        $this->dispatchBrowserEvent('updatedMapLocation', [
            'lat' => $coordinates->getLatitude(),
            'lng' => $coordinates->getLongitude()
        ]);
    }

    public function render()
    {
        return view('livewire.map-search-box');
    }
}
