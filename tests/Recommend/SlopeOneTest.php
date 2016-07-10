<?php namespace KevBaldwyn\Tests\Miner\Recommend;

use KevBaldwyn\Miner\Data\Set;
use KevBaldwyn\Miner\Recommend\SlopeOne;
use KevBaldwyn\Tests\Miner\BaseTestCase;

class SlopeOneTest extends BaseTestCase {

    public function test_recommend()
    {
        $r = new SlopeOne(new Set(self::data(null, 1)));
        $recommendations = $r->recommend('ben');

        $this->assertSame('Whitney Houston', $recommendations->first()->getKey());
        $this->assertSame(3.25, $recommendations->first()->getValue());
    }

}