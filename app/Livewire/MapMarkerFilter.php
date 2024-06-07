<?php

namespace App\Livewire;

use Livewire\Component;

class MapMarkerFilter extends Component
{
    public $options = [
        ['id' => 1, 'label' => 'Area1'],
        ['id' => 2, 'label' => 'Area2'],
    ];
    public function filterMarkers($filterId, $coords)
    {
        // Using filterId, get marker ids that should be removed from the map
        // $toRemove sample: ["-19.19356730928235_125.40645731663705", "..."]
        $toRemove = (new \App\Http\Services\MapMarkerFilter)
            ->getCoordsToRemove($filterId, $coords);

        // Send this back to the view
        $this->dispatchBrowserEvent('removeMarkers', [
            'coords' => $toRemove
        ]);
    }
    public function render()
    {
        return view('livewire.map-marker-filter');
    }
}
