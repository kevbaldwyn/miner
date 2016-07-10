<?php namespace KevBaldwyn\Tests\Miner\Strategy\Similarity;

use KevBaldwyn\Miner\Data\Sortable\Collection;
use KevBaldwyn\Miner\Data\Sortable\Item;
use KevBaldwyn\Miner\Strategy\Similarity\Cosine;
use KevBaldwyn\Tests\Miner\BaseTestCase;

class CosineTest extends BaseTestCase {

    public function test_calculate()
    {
        $this->assertSame(0.92462794322100683, (new Cosine())->calculate(
            self::data('angelica'),
            self::data('veronica'))
        );
    }


    public function test_sort()
    {
        $s = new Cosine();
        $res = $s->sort(new Collection([
            new Item('last', -1),
            new Item('middle', 0),
            new Item('first', 1)
        ]));

        $this->assertSame('last', $res->last()->getKey());
        $this->assertSame('first', $res->first()->getKey());
    }

}