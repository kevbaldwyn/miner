<?php namespace KevBaldwyn\Miner\Classify\NeighbourMethod;

use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Data\Set;
use KevBaldwyn\Miner\Data\Sortable\Item;
use KevBaldwyn\Miner\Utils\Arr;

class KNearestNeighbour extends NearestNeighbour {

    public function __construct(Set $trainingSet, $normalise = true, $k = 5)
    {
        $this->k = $k;
        parent::__construct($trainingSet, $normalise);
    }


    /**
     * find the nearest through a process of casting votes for each of the classes for the objects that are K Nearest to the object to classify
     * @param Set $trainingSet
     * @param Set $attributeData
     * @param Collection $toClassify
     * @param Point $classification
     * @return Item
     */
    public function computeNearest(Set $classifiedSet, Collection $toClassify, Point $classification)
    {
        $neighbours = parent::getNearest($classifiedSet, $toClassify);

        // cast a vote for each classification
        $votes = [];
        foreach($neighbours as $neighbour) {
            $class = $this->getClassification($classification, $neighbour)->getValue();
            $votes[$class][] = $neighbour;
        }

        return Arr::first(Arr::getMaxCounts($votes));
    }


}