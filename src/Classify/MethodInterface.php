<?php namespace KevBaldwyn\Miner\Classify;

use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Data\Set;

interface MethodInterface {

    /**
     * @param Set $trainingSet
     * @param Set $attributeData
     * @param Collection $toClassify
     * @param Point $classification
     * @return mixed
     */
    public function computeNearest(Set $trainingSet, Set $attributeData, Collection $toClassify, Point $classification);

}