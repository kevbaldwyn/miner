<?php namespace KevBaldwyn\Miner\Classify;

use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Data\Set;
use KevBaldwyn\Miner\Recommend\Neighbour;
use KevBaldwyn\Miner\Strategy\Distance\Manhattan;

/**
 * A classifier uses a set of objects that are already labeled with the class they belong to.
 * It uses that set to classify new, unlabeled objects, based on attributes common to all objects in the set
 * Class Classifier
 * @package KevBaldwyn\Miner\Classify
 */
class Classifier {

    /**
     * @var Set the objects with known attributes
     */
    private $classifiedSet;

    public function __construct(Set $classifiedSet)
    {
        $this->classifiedSet = $classifiedSet;
    }


    /**
     * @param Set $knownClassifications the data set of known classifications to use to classify against
     * @param Collection $data the set of attributes to classify
     * @param Point $classification the classification data point to return
     * @return Point
     */
    public function classify(Set $knownClassifications, Collection $data, Point $classification)
    {
        $nearest = $this->getNearest($data)->getKey();

        // return the wanted classification from the known classifications
        return $knownClassifications->getDataFor($nearest)->getDataPoint($classification);
    }


    /**
     * @param Collection $data
     * @return Point
     */
    protected function getNearest(Collection $data)
    {
        // add the attribute data and key to the set of classified attributes
        $d = clone $this->classifiedSet;
        $d->put($data->getName(), $data);

        // find the nearest neighbour to it
        $r = new Neighbour($d, new Manhattan());
        return $r->getNearestNeighbour($data->getName())->first();
    }

}