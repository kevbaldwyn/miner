<?php namespace KevBaldwyn\Miner\Classify\Method;

use KevBaldwyn\Miner\Classify\MethodInterface;
use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Data\Set;
use KevBaldwyn\Miner\Recommend\Neighbour;
use KevBaldwyn\Miner\Strategy\Distance\Manhattan;

class NearestNeighbour implements MethodInterface {

    /**
     * find the nearest neighbour, using Manhattan distance
     * @param Set $data
     * @return mixed
     */
    public function computeNearest(Set $trainingSet, Set $classifications, Collection $data, Point $classification)
    {
        // $k is 1 and currently regardless of the value of $k we always get the first (closest)
        // this might mean the closest we get is in fact an outlier
        // to handle this better use KNearestNeighbour instead
        $r = new Neighbour($classifications, new Manhattan());
        return $r->getNearestNeighbour($data->getName())->first();
    }

}