<?php namespace KevBaldwyn\Miner\Data;

use Illuminate\Support\Collection as BaseCollection;

class Collection extends BaseCollection {

    private $name;

    /**
     * @param array $items
     * @param null $name optional key / name for the collection
     */
    public function __construct($items = [], $name = null)
    {
        $items = (new BaseCollection($items))->transform(function($item) {
            if(!$item instanceof Point) {
                return new Point($item[0], $item[1]);
            }
            return $item;
        })->all();

        $this->name = $name;

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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
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


    public function sortByKey()
    {
        return $this->sortBy(function(Point $item) {
            return $item->getKey();
        }, SORT_REGULAR);
    }


    public function getVector()
    {
        $ar = [];
        $collection = $this->sortByKey();
        foreach($collection as $item) {
            $ar[] = $item->getValue();
        }
        return $ar;
    }
}