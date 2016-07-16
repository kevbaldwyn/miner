<?php namespace KevBaldwyn\Miner\Classify;

use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;

interface ClassifierInterface {

    public function classify(Collection $toClassify, Point $classification);

}