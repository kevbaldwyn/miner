<?php namespace KevBaldwyn\Miner\Data;

use Illuminate\Support\Collection as BaseCollection;

class Collection extends BaseCollection {

    public function __construct($items = [])
    {
        $items = (new BaseCollection($items))->transform(function($item) {
            if(!$item instanceof Point) {
                return new Point($item[0], $item[1]);
            }
            return $item;
        })->all();

        parent::__construct($items);
    }


    public static function fromKeyValuePairs(array $data)
    {
        $c = new static([]);
        foreach($data as $k => $v) {
            $c->push(new Point($k, $v));
        }
        return $c;
    }


    public function hasDataPoint(Point $dataPoint)
    {
        return !is_null($this->getDataPoint($dataPoint));
    }


    public function getDataPoint(Point $dataPoint)
    {
        return $this->filter(function(Point $point) use ($dataPoint) {
            return $point->getKey() == $dataPoint->getKey();
        })->first();
    }


    public function padMissingPoints(Collection $data)
    {
        foreach($data as $point) {
            if(!$this->hasDataPoint($point)) {
                $this->items[] = new Point($point->getKey(), 0);
            }
        }
    }


    public function sortByValue()
    {
        return $this->sortBy(function(Point $item) {
            return $item->getValue();
        }, SORT_REGULAR, true);
    }
}