<?php namespace KevBaldwyn\Miner\Strategy;

use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Sortable\Collection as SortableCollection;

interface StrategyInterface {

    public function calculate(Collection $data1, Collection $data2);

    /**
     * @param SortableCollection $collection
     * @return SortableCollection
     */
    public function sort(SortableCollection $collection);
}