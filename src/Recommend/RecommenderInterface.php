<?php namespace KevBaldwyn\Miner\Recommend;

use KevBaldwyn\Miner\Data\Collection;

interface RecommenderInterface {

    /**
     * @param $to
     * @return Collection
     */
    public function recommend($to, $limit = 5);

}