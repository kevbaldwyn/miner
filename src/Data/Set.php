<?php namespace KevBaldwyn\Miner\Data;

use KevBaldwyn\Miner\Utils\Arr;
use KevBaldwyn\Miner\Utils\Maths;
use Illuminate\Support\Collection as BaseCollection;

class Set extends BaseCollection {

    private $deviations;
    private $frequencies;

    public function __construct($items = [])
    {
        parent::__construct($items);
    }

    /**
     * @param $who
     * @return Collection
     */
    public function getDataFor($who)
    {
        return $this->get($who);
    }

    public function exclude($who)
    {
        $return = [];
        foreach($this->items as $k => $data) {
            if($who != $k) {
                $return[$k] = $data;
            }
        }
        return new static($return);
    }

    public function getMissingPointsInData(Collection $dataPoints)
    {
        $missing = new Collection([]);
        $this->computeDeviations();
        foreach($this->deviations as $item => $data) {
            $point = Point::named($item);
            if(!$dataPoints->hasDataPoint($point)) {
                $missing->push($point);
            }
        }

        return $missing;
    }

    private function computeDeviations()
    {
        if(is_null($this->deviations) || is_null($this->frequencies)) {
            $deviations = [];
            $frequencies = [];

            foreach ($this->items as $data) {
                // foreach item in the set we need to get the deviation for it against all other items
                foreach ($data as $dataPoint1) {
                    foreach ($data as $dataPoint2) {
                        if (!$dataPoint1->isSameKeyAs($dataPoint2)) {
                            $arKey = $dataPoint1->getKey() . '.' . $dataPoint2->getKey();
                            Arr::increment($deviations, $arKey, Maths::difference($dataPoint1, $dataPoint2));
                            Arr::increment($frequencies, $arKey);
                        }
                    }
                }
            }

            foreach ($deviations as $item => $ratings) {
                foreach ($ratings as $item2 => $ratings2) {
                    $ratings[$item2] /= $frequencies[$item][$item2];
                }
            }

            $this->deviations  = $deviations;
            $this->frequencies = $frequencies;
        }
    }

    public function getDeviations()
    {
        $this->computeDeviations();
        return $this->deviations;
    }

    public function getFrequencies()
    {
        $this->computeDeviations();
        return $this->frequencies;
    }

    public function getNormalised()
    {
        $support = new DataSetSupport($this);
        return $this->transform(function(Collection $data) use ($support) {
            $collection = new Collection([], $data->getName());
            foreach($data as $point) {
                $collection->push(new Point($point->getKey(), $support->getModifiedStandardScoreFor($point)));
            }
            return $collection;
        });
    }
}