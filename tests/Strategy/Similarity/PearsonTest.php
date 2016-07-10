<?php namespace KevBaldwyn\Tests\Miner\Strategy\Similarity;

use KevBaldwyn\Miner\Data\Sortable\Collection;
use KevBaldwyn\Miner\Data\Sortable\Item;
use KevBaldwyn\Miner\Strategy\Similarity\Pearson;
use KevBaldwyn\Tests\Miner\BaseTestCase;

class PearsonTest extends BaseTestCase {

    public function test_calculate()
    {
        $this->assertSame(0.42008402520840293, (new Pearson())->calculate(
            self::data('angelica'),
            self::data('hailey'))
        );
        $this->assertSame(-0.90405349906826993, (new Pearson())->calculate(
            self::data('angelica'),
            self::data('bill'))
        );
    }


    public function test_sort()
    {
        $s = new Pearson();
        $res = $s->sort(new Collection([
            new Item('last', -1),
            new Item('middle', 0),
            new Item('first', 1)
        ]));

        $this->assertSame('last', $res->last()->getKey());
        $this->assertSame('first', $res->first()->getKey());
    }

}