<?php namespace KevBaldwyn\Tests\Miner\Distance;

use KevBaldwyn\Miner\Strategy\Distance\Manhattan;
use KevBaldwyn\Tests\Miner\BaseTestCase;

class ManhattanTest extends BaseTestCase {

    public function test_calculate()
    {
        $data1 = self::data('hailey');
        $data2 = self::data('veronica');

        $this->assertSame(2.0, (new Manhattan())->calculate($data1, $data2));
    }

}