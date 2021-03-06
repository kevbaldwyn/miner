<?php namespace KevBaldwyn\Miner\Classify;

use KevBaldwyn\Miner\Classify\NeighbourMethod\KNearestNeighbour;
use KevBaldwyn\Miner\Classify\NeighbourMethod\NearestNeighbour;
use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Data\Set;

class Neighbour implements ClassifierInterface {

    /**
     * @var Set the objects with known attributes
     */
    private $classifiedSet;

    /**
     * @var NearestNeighbour|KNearestNeighbour
     */
    private $method;

    /**
     * @param Set $classifiedSet
     * @param NearestNeighbour|KNearestNeighbour $method the method to be used to perform the classification
     */
    public function __construct(Set $classifiedSet, NearestNeighbour $method)
    {
        $this->classifiedSet = $classifiedSet;
        $this->method        = $method;
    }

    /**
     * @param Collection $toClassify the set of attributes to classify
     * @param Point $classification the classification data point to return
     * @return Point
     */
    public function classify(Collection $toClassify, Point $classification)
    {
        $nearest = $this->method->computeNearest($this->classifiedSet, $toClassify, $classification);
        return $this->method->getClassification($classification, $nearest);
    }

}