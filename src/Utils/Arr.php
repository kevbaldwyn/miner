<?php namespace KevBaldwyn\Miner\Utils;

use Illuminate\Support\Arr as BaseArr;

class Arr extends BaseArr {

    public static function increment(array &$array, $key, $value = 1, $default = 0)
    {
        if($value instanceof \Closure) {
            $value = $value();
        }
        parent::set(
            $array,
            $key,
            parent::get(
                $array,
                $key,
                $default
            ) + $value
        );
    }

    public static function getMaxCounts(array $array)
    {
        $c = [];
        foreach($array as $k => $ar) {
            $c[$k] = count($ar);
        }
        return $array[array_search(max($c), $c)];
    }

}