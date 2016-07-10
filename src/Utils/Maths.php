<?php namespace KevBaldwyn\Miner\Utils;

use KevBaldwyn\Miner\Data\Point;

class Maths {

    /**
     * sum the values in an array
     * @param array $values
     * @return number
     */
    public static function sum(array $values, \Closure $modifier = null)
    {
        if(!is_null($modifier)) {
            foreach($values as $index => $value) {
                $values[$index] = $modifier($value);
            }
        }
        return array_sum($values);
    }

    /**
     * gets the weight of a value from a set of values
     * @param array $values
     */
    public static function weighting($value, array $values)
    {
        return $value / self::sum($values);
    }

    public static function subtract($one, $two)
    {
        return static::value($one) - static::value($two);
    }

    public static function add($one, $two)
    {
        return static::value($one) + static::value($two);
    }

    public static function multiply($one, $two)
    {
        return static::value($one) * static::value($two);
    }

    public static function divide($one, $two)
    {
        return static::value($one) / static::value($two);
    }

    public static function difference($one, $two)
    {
        return static::value($one) - static::value($two);
    }

    public static function median(array $values)
    {
        $middleIndex = (integer) floor(count($values) / 2);
        sort($values, SORT_NUMERIC);

        // assumes an odd number
        $median = $values[$middleIndex];

        // if even number then average 2 middle values
        if ($middleIndex % 2 == 0) {
            $median = ($median + $values[$middleIndex - 1]) / 2;
        }

        return $median;

    }

    protected static function value($value)
    {
        if($value instanceof Point) {
            $value = $value->getValue();
        }
        return $value;
    }
}