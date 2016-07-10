<?php namespace KevBaldwyn\Tests\Miner\Strategy\Distance;

use KevBaldwyn\Miner\Data\Sortable\Collection;
use KevBaldwyn\Miner\Data\Sortable\Item;
use KevBaldwyn\Miner\Strategy\Distance\Minkowski;
use KevBaldwyn\Tests\Miner\BaseTestCase;

class MinkowskiTest extends BaseTestCase {

    public function test_calculate()
    {
        $data1 = self::data('hailey');
        $data2 = self::data('veronica');

        $this->assertSame(1.4142135623731, (new Minkowski(Minkowski::R_EUCLIDEAN))->calculate($data1, $data2));
        $this->assertSame(2.0, (new Minkowski(Minkowski::R_MANHATTAN))->calculate($data1, $data2));
    }

    public function test_sort()
    {
        $s = new Minkowski();
        $res = $s->sort(new Collection([
            new Item('last', 1),
            new Item('middle', 0.5),
            new Item('first', 0)
        ]));

        $this->assertSame('last', $res->last()->getKey());
        $this->assertSame('first', $res->first()->getKey());
    }
}