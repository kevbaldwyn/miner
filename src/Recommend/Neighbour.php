<?php namespace KevBaldwyn\Miner\Recommend;

use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Data\Set;
use KevBaldwyn\Miner\Data\Sortable\Item as SortableItem;
use KevBaldwyn\Miner\Data\Sortable\Collection as SortableCollection;
use KevBaldwyn\Miner\Strategy\StrategyInterface;
use KevBaldwyn\Miner\Utils\Maths;

class Neighbour implements RecommenderInterface {

    private $dataSet;
    private $strategy;
    private $k;

    public function __construct(Set $dataSet, StrategyInterface $strategy, $k = 1)
    {
        $this->dataSet = $dataSet;
        $this->strategy = $strategy;
        $this->k = $k;
    }

    /**
     * @param $to
     * @return Collection
     */
    public function recommend($to, $limit = 5)
    {
        $recommendations = [];

        $nearest     = $this->getNearestNeighbour($to, $this->strategy, $this->k);
        $distances   = $nearest->asDistancesArray();
        $userRatings = $this->dataSet->getDataFor($to);

        foreach($nearest as $neighbour) {
            $weighting = Maths::weighting($neighbour->getDistance(), $distances);
            $neighbourData = $this->dataSet->getDataFor($neighbour->getKey());
            foreach($neighbourData as $dataPoint) {
                if(!$userRatings->hasDataPoint($dataPoint)) {
                    $recommendations[$dataPoint->getKey()][] = Maths::multiply($dataPoint, $weighting);
                }
            }
        }

        // create a new collection to return
        $collection = new Collection([]);
        foreach($recommendations as $key => $values) {
            $collection->push(new Point($key, Maths::sum($values)));
        }

        return $collection->sortByValue()->slice(0, $limit);
    }

    /**
     * @param $to
     * @return SortableCollection
     */
    public function getNearestNeighbour($to, StrategyInterface $strategy = null, $k = null)
    {
        if(is_null($strategy)) {
            $strategy = $this->strategy;
        }
        if(is_null($k)) {
            $k = $this->k;
        }
        $collection = $this->getSortedClosest($to, $strategy);
        return $collection->slice(0, $k);
    }

    /**
     * @param $to
     * @return SortableCollection
     */
    private function getSortedClosest($to, StrategyInterface $strategy)
    {
        $distances = new SortableCollection([]);

        // ignore $to
        $data   = $this->dataSet->exclude($to);
        $meData = $this->dataSet->getDataFor($to);

        foreach($data as $who => $neighbourData) {
            $distance = $strategy->calculate($meData, $neighbourData);
            $distances->push(new SortableItem($who, $distance));
        }

        return $strategy->sort($distances);
    }
}