<?php namespace KevBaldwyn\Miner\Strategy\Similarity;

use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Strategy\StrategyInterface;
use KevBaldwyn\Miner\Utils\Maths;
use KevBaldwyn\Miner\Data\Sortable\Collection as SortableCollection;
use KevBaldwyn\Miner\Data\Sortable\Item;

class Cosine implements StrategyInterface {

    public function calculate(Collection $data1, Collection $data2)
    {
        $data1->padMissingPoints($data2);
        $data2->padMissingPoints($data1);

        $dotProduct = 0;
        $sqrX = 0;
        foreach ($data1 as $pointX) {
            if($data2->hasDataPoint($pointX)) {
                $pointY = $data2->getDataPoint($pointX);
                $sqrX += pow($pointX->getValue(), 2);
                $dotProduct += Maths::multiply($pointX, $pointY);
            }
        }

        if (!$sqrX) {
            return 0;
        }

        $x = sqrt($sqrX);
        $sqrY = 0;

        foreach ($data2 as $pointY) {
            $sqrY += pow($pointY->getValue(), 2);
        }

        $y = sqrt($sqrY);
        return $dotProduct / Maths::multiply($x, $y);
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