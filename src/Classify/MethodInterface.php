<?php namespace KevBaldwyn\Miner\Classify;

use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Data\Set;

interface MethodInterface {

    public function computeNearest(Set $trainingSet, Set $classifications, Collection $data, Point $classification);

}