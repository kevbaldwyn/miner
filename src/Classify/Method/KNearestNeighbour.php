<?php namespace KevBaldwyn\Miner\Classify\Method;

use KevBaldwyn\Miner\Classify\MethodInterface;
use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Data\Set;
use KevBaldwyn\Miner\Data\Sortable\Item;
use KevBaldwyn\Miner\Recommend\Neighbour;
use KevBaldwyn\Miner\Strategy\Distance\Manhattan;
use KevBaldwyn\Miner\Utils\Arr;

class KNearestNeighbour implements MethodInterface {

    private $k;

    public function __construct($k = 5)
    {
        $this->k = $k;
    }


    /**
     * find the nearest through a process of casting votes for each of the classes for the objects that are K Nearest to the object to classify
     * @param Set $trainingSet
     * @param Set $attributeData
     * @param Collection $toClassify
     * @param Point $classification
     * @return Item
     */
    public function computeNearest(Set $trainingSet, Set $attributeData, Collection $toClassify, Point $classification)
    {
        $r = new Neighbour($attributeData, new Manhattan(), $this->k);
        $neighbours = $r->getNearestNeighbour($toClassify->getName());

        // cast a vote for each classification
        $votes = [];
        foreach($neighbours as $neighbour) {
            $class = $trainingSet->getDataFor($neighbour->getKey())
                        ->getDataPoint($classification)
                        ->getValue();
            $votes[$class][] = $neighbour;
        }

        return Arr::first(Arr::getMaxCounts($votes));
    }


}