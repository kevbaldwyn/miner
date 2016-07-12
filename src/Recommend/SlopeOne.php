<?php namespace KevBaldwyn\Miner\Recommend;

use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Utils\Arr;
use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Set;
use KevBaldwyn\Miner\Utils\Maths;

class SlopeOne implements RecommenderInterface {

    private $dataSet;

    public function __construct(Set $dataSet)
    {
        $this->dataSet = $dataSet;
    }

    /**
     * @param $to
     * @return Collection
     */
    public function recommend($to, $limit = 5)
    {
        $recommendations = [];
        $frequencies = [];
        $userRatings = $this->dataSet->getDataFor($to);

        foreach($userRatings as $userDataPoint) {

            foreach($this->dataSet->getDeviations() as $item => $data) {
                $dataPoint  = Point::named($item);
                $dataPoints = Collection::fromKeyValuePairs($data);

                if(!$userRatings->hasDataPoint($dataPoint) && $dataPoints->hasDataPoint($userDataPoint)) {
                    $freq = Arr::get($this->dataSet->getFrequencies(), $dataPoint->getKey() . '.' . $userDataPoint->getKey());
                    Arr::increment(
                        $recommendations,
                        $dataPoint->getKey(),
                        Maths::multiply(Maths::add($dataPoints->getDataPoint($userDataPoint), $userDataPoint), $freq)
                    );
                    Arr::increment($frequencies, $dataPoint->getKey(), $freq);
                }
            }
        }

        $collection = new Collection([]);
        foreach($recommendations as $k => $v) {
            $collection->push(new Point($k, Maths::divide($v, $frequencies[$k])));
        }

        return $collection->sortByValue()->slice(0, $limit);
    }




}