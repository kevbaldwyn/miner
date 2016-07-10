<?php namespace KevBaldwyn\Miner\Strategy\Similarity;

use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Strategy\StrategyInterface;
use KevBaldwyn\Miner\Data\Sortable\Collection as SortableCollection;
use KevBaldwyn\Miner\Data\Sortable\Item;

class Pearson implements StrategyInterface {

    public function calculate(Collection $data1, Collection $data2)
    {
        $sumXY = $sumX = $sumY = $sumXsq = $sumYsq = $n = 0;

        foreach($data1 as $point1) {
            if($data2->hasDataPoint($point1)) {
                $point2 = $data2->getDataPoint($point1);
                $n ++;
                $x = $point1->getValue();
                $y = $point2->getValue();
                $sumXY += $x * $y;
                $sumX += $x;
                $sumY += $y;
                $sumXsq += pow($x, 2);
                $sumYsq += pow($y, 2);
            }
        }

        if($n == 0) {
            return 0;
        }

        $denominator = sqrt($sumXsq - pow($sumX, 2) / $n) *
                       sqrt($sumYsq - pow($sumY, 2) / $n);

        if($denominator == 0) {
            return 0;
        }

        return ($sumXY - ($sumX * $sumY) / $n) / $denominator;
    }

    /**
     * @param SortableCollection $collection
     * @return SortableCollection
     */
    public function sort(SortableCollection $collection)
    {
        return $collection->sortBy(function(Item $a) {
            return 1 - $a->getDistance();
        });
    }

}