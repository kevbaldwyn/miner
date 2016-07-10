<?php namespace KevBaldwyn\Tests\Data;

use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;

class CollectionTest extends \PHPUnit_Framework_TestCase {

    public function test_getDataPoint()
    {
        $collection = new Collection([
            new Point('Key1', 1),
            new Point('Key2', 2)
        ]);
        $this->assertSame(2, $collection->getDataPoint(new Point('Key2', 3))->getValue());
    }

    public function test_hasDataPoint()
    {
        $collection = new Collection([
            new Point('Key1', 1),
            new Point('Key2', 2)
        ]);
        $this->assertTrue($collection->hasDataPoint(new Point('Key2', 3)));
        $this->assertFalse($collection->hasDataPoint(new Point('Key5', 3)));
    }

    public function test_sortByValue()
    {
        $collection = new Collection([
            new Point('Key1', 1),
            new Point('Key2', 2.4)
        ]);

        $sorted = $collection->sortByValue();
        $this->assertSame('Key2', $sorted->first()->getKey());
    }

}