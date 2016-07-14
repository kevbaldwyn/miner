<?php namespace KevBaldwyn\Miner\Classify\Method;

use KevBaldwyn\Miner\Classify\MethodInterface;
use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Data\Set;
use KevBaldwyn\Miner\Recommend\Neighbour;
use KevBaldwyn\Miner\Strategy\Distance\Manhattan;
use KevBaldwyn\Miner\Utils\Arr;

class KNearestNeighbour implements MethodInterface {

    private $k;

    public function __construct($k = 5)
    {
        $this->k = $k;
    }

    public function computeNearest(Set $trainingSet, Set $classifications, Collection $data, Point $classification)
    {
        $r = new Neighbour($classifications, new Manhattan(), $this->k);
        $neighbours = $r->getNearestNeighbour($data->getName());

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