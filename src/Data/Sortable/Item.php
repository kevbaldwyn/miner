<?php namespace KevBaldwyn\Miner\Data\Sortable;

class Item {

    private $key;
    private $distance;

    public function __construct($key, $distance)
    {
        $this->key = $key;
        $this->distance = $distance;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getDistance()
    {
        return $this->distance;
    }


}