<?php namespace KevBaldwyn\Tests\Miner\Data\Sortable;

use KevBaldwyn\Miner\Data\Sortable\Collection;
use KevBaldwyn\Miner\Data\Sortable\Item;
use KevBaldwyn\Tests\Miner\BaseTestCase;

class CollectionTest extends BaseTestCase {

    public function test_calculateTotalDistance()
    {
        $c = new Collection([
            new Item('key1', 0.1),
            new Item('key2', 1.2),
            new Item('key3', 2)
        ]);

        $this->assertSame(3.3, $c->totalDistance());
    }

    public function test_asDistancesArray()
    {
        $c = new Collection([
            new Item('key1', 0.1),
            new Item('key2', 1.2),
            new Item('key3', 2)
        ]);

        $this->assertSame([0.1, 1.2, 2], $c->asDistancesArray());
    }

}