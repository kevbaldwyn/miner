<?php namespace KevBaldwyn\Miner\Data\Sortable;

use Illuminate\Support\Collection as BaseCollection;

class Collection extends BaseCollection {

    public function totalDistance()
    {
        $distance = 0;
        foreach($this->items as $item) {
            $distance += $item->getDistance();
        }
        return $distance;
    }

    public function asDistancesArray()
    {
        return $this->map(function(Item $item) {
            return $item->getDistance();
        })->toArray();
    }
}