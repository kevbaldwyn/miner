<?php namespace KevBaldwyn\Miner\Strategy\Distance;

use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Sortable\Item;
use KevBaldwyn\Miner\Strategy\StrategyInterface;
use KevBaldwyn\Miner\Utils\Maths;
use KevBaldwyn\Miner\Data\Sortable\Collection as SortableCollection;

class Minkowski implements StrategyInterface {

    const R_MANHATTAN = 1;
    const R_EUCLIDEAN = 2;

    private $r;

    public function __construct($r = self::R_EUCLIDEAN)
    {
        $this->r = $r;
    }


    /**
     * @param Collection $data1
     * @param Collection $data2
     * @param int $r the greater the value of $r the more a large difference in one dimension will influence the total difference
     * @return int|number
     */
    public function calculate(Collection $data1, Collection $data2)
    {
        $distance = 0;
        $common = false;
        foreach($data1 as $point1) {
            if($data2->hasDataPoint($point1)) {
                $distance += pow(abs(Maths::subtract($point1, $data2->getDataPoint($point1))), $this->r);
                $common = true;
            }
        }
        if($common) {
            return pow($distance, 1/$this->r);
        }
        return 0;
    }

    /**
     * @param SortableCollection $collection
     * @return SortableCollection
     */
    public function sort(SortableCollection $collection)
    {
        return $collection->sortBy(function(Item $a) {
            return $a->getDistance();
        });
    }
}