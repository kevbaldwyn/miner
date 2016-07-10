<?php namespace KevBaldwyn\Miner\Strategy\Distance;

class Manhattan extends Minkowski {

    public function __construct()
    {
        parent::__construct(self::R_MANHATTAN);
    }
}