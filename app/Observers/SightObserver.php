<?php

namespace App\Observers;

use App\Models\Sight;

class SightObserver
{
    /**
     * Handle the Sight "creating" event.
     */
    public function creating(Sight $sight): void
    {
        if (is_null($sight->latitude) && is_null($sight->longitude)) {
            $fullAddress = $sight->address_street . ', '
                . $sight->address_postcode . ', ';
            // . $sight->city . ', '
            // . $sight->country;
            $result = app('geocoder')->geocode($fullAddress)->get();
            if ($result->isNotEmpty()) {
                $coordinates = $result[0]->getCoordinates();
                $sight->latitude = $coordinates->getLatitude();
                $sight->longitude = $coordinates->getLongitude();
            }
        }
    }
    /**
     * Handle the Sight "created" event.
     */
    public function created(Sight $sight): void
    {
        //
    }

    /**
     * Handle the Sight "updated" event.
     */
    public function updated(Sight $sight): void
    {
        //
    }

    /**
     * Handle the Sight "deleted" event.
     */
    public function deleted(Sight $sight): void
    {
        //
    }

    /**
     * Handle the Sight "restored" event.
     */
    public function restored(Sight $sight): void
    {
        //
    }

    /**
     * Handle the Sight "force deleted" event.
     */
    public function forceDeleted(Sight $sight): void
    {
        //
    }
}
