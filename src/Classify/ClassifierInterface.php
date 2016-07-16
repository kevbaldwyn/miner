<?php namespace KevBaldwyn\Miner\Classify;

use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;

interface ClassifierInterface {

    /**
     * @param Collection $toClassify the set of attributes to classify
     * @param Point $classification the classification data point to return
     * @return Point
     */
    public function classify(Collection $toClassify, Point $classification);

}