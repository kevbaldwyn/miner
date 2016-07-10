<?php namespace KevBaldwyn\Miner\Data;

class Point {

    private $key;
    private $value;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
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
    public function getValue()
    {
        return $this->value;
    }

    public function isSameKeyAs(Point $point)
    {
        return $point->getKey() == $this->getKey();
    }

}