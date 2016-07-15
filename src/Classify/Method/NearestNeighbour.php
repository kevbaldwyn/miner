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
     * @param Set $trainingSet
     * @param Set $attributeData
     * @param Collection $toClassify
     * @param Point $classification
     * @return mixed
     */
    public function computeNearest(Set $trainingSet, Set $attributeData, Collection $toClassify, Point $classification)
    {
        // $k is 1 and currently regardless of the value of $k we always get the first (closest)
        // this might mean the closest we get is in fact an outlier
        // to handle this better use KNearestNeighbour instead
        $r = new Neighbour($attributeData, new Manhattan());
        return $r->getNearestNeighbour($toClassify->getName())->first();
    }

}