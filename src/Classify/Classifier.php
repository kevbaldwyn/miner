<?php namespace KevBaldwyn\Miner\Classify;

use KevBaldwyn\Miner\Classify\Method\NearestNeighbour;
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

    private $method;

    public function __construct(Set $classifiedSet, MethodInterface $method = null)
    {
        if(is_null($method)) {
            $method = new NearestNeighbour();
        }

        $this->classifiedSet = $classifiedSet;
        $this->method        = $method;
    }


    /**
     * @param Set $trainingSet the data set of known classifications to use to classify against
     * @param Collection $data the set of attributes to classify
     * @param Point $classification the classification data point to return
     * @return Point
     */
    public function classify(Set $trainingSet, Collection $toClassify, Point $classification, $normalise = true)
    {
        $attributeData = $this->prepareData($toClassify, $normalise, $classification);

        $nearest = $this->method->computeNearest($trainingSet, $attributeData, $toClassify, $classification);

        // return the wanted classification from the known classifications
        return $trainingSet->getDataFor($nearest->getKey())->getDataPoint($classification);
    }


    /**
     * @param Collection $data
     * @return Point
     */
    protected function prepareData(Collection $data, $normalise)
    {
        // add the attribute data and key to the set of classified attributes
        $d = clone $this->classifiedSet;
        $d->put($data->getName(), $data);

        if($normalise) {
            $d = $d->getNormalised();
        }

        return $d;
    }

}