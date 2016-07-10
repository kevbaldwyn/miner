<?php namespace KevBaldwyn\Tests\Miner\Utils;

use KevBaldwyn\Miner\Utils\Maths;

class MathsTest extends \PHPUnit_Framework_TestCase {

    public function test_sum_basic()
    {
        $this->assertSame(5, Maths::sum([1, 2, 2]));
    }

    public function test_sum_modifier()
    {
        $this->assertSame(8, Maths::sum([1, 2, 2], function($value) {
            return $value + 1;
        }));
    }

    public function test_weighting()
    {
        $this->assertSame(0.4, Maths::weighting(2, [1, 2, 2]));
    }
}