<?php namespace KevBaldwyn\Miner\Classify\NeighbourMethod;

use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Data\Set;
use KevBaldwyn\Miner\Data\Sortable\Item;
use KevBaldwyn\Miner\Recommend\Neighbour;
use KevBaldwyn\Miner\Strategy\Distance\Manhattan;

class NearestNeighbour {

    protected $normalise;
    protected $trainingSet;
    protected $k = 1;

    /**
     * @param Set $trainingSet the data set of known classifications to use to classify against
     * @param bool $normalise
     */
    public function __construct(Set $trainingSet, $normalise = true)
    {
        $this->trainingSet = $trainingSet;
        $this->normalise   = $normalise;
    }

    /**
     * find the nearest neighbour, using Manhattan distance
     * @param Set $trainingSet
     * @param Set $attributeData
     * @param Collection $toClassify
     * @param Point $classification
     * @return Item
     */
    public function computeNearest(Set $classifiedSet, Collection $toClassify, Point $classification)
    {
        return $this->getNearest($classifiedSet, $toClassify)->first();
    }


    /**
     * @param Set $classifiedSet
     * @param Collection $toClassify
     * @return \KevBaldwyn\Miner\Data\Sortable\Collection
     */
    protected function getNearest(Set $classifiedSet, Collection $toClassify)
    {
        $attributeData = $this->prepareData($classifiedSet, $toClassify);

        // $k is 1 and currently regardless of the value of $k we always get the first (closest)
        // this might mean the closest we get is in fact an outlier
        // to handle this better use KNearestNeighbour instead
        $r = new Neighbour($attributeData, new Manhattan(), $this->k);
        return $r->getNearestNeighbour($toClassify->getName());
    }


    /**
     * @param Point $classification
     * @param Item $nearest the computed nearest
     * @return Point
     */
    public function getClassification(Point $classification, Item $nearest)
    {
        // return the wanted classification from the known classifications
        return $this->trainingSet->getDataFor($nearest->getKey())->getDataPoint($classification);
    }


    /**
     * @param Set $classifiedSet
     * @param Collection $data
     * @return Point
     */
    protected function prepareData(Set $classifiedSet, Collection $data)
    {
        // add the attribute data and key to the set of classified attributes
        $d = clone $classifiedSet;
        $d->put($data->getName(), $data);

        if($this->normalise) {
            $d = $d->getNormalised();
        }

        return $d;
    }

}