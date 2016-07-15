<?php namespace KevBaldwyn\Tests\Miner\Utils;

use KevBaldwyn\Miner\Utils\Arr;
use KevBaldwyn\Tests\Miner\BaseTestCase;

class ArrTest extends BaseTestCase {

    public function test_increment()
    {
        $ar = [];
        
        // create the key and set the default to 2
        // increment by 1
        Arr::increment($ar, 'key.name', 1, 2);
        $this->assertSame(3, Arr::get($ar, 'key.name'));

        // increment the same key by 3
        Arr::increment($ar, 'key.name', 3);
        $this->assertSame(6, Arr::get($ar, 'key.name'));
    }

    public function test_getMaxCounts()
    {
        $target = [4, 5, 2, 3, 6, 9, 1];

        $this->assertSame($target, Arr::getMaxCounts([
            'foo' => [1, 2, 3, 4, 5],
            'bar' => [4, 5],
            'farb' => $target
        ]));
    }

}