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
        $result = app('geocoder')->geocode($this->address)->get();
        if ($result->isNotEmpty()) {
            $coordinates = $result[0]->getCoordinates();
            // Dispatch event to the page
            $this->dispatch('updatedMapLocation', [
                'lat' => $coordinates->getLatitude(),
                'lng' => $coordinates->getLongitude()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.map-search-box');
    }
}
