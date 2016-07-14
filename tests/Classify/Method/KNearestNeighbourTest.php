<?php namespace KevBaldwyn\Tests\Miner\Classify\Method;

use KevBaldwyn\Miner\Classify\Method\KNearestNeighbour;
use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Data\Set;
use KevBaldwyn\Tests\Miner\BaseTestCase;

class KNearestNeighbourTest extends BaseTestCase {

    public function test_compute()
    {
        $n = new KNearestNeighbour(3);
        $res = $n->computeNearest(
            new Set([
                'one' => new Collection([
                    new Point('type', 'toddler')
                ]),
                'two' => new Collection([
                    new Point('type', 'child')
                ]),
                'three' => new Collection([
                    new Point('type', 'child')
                ]),
                'four' => new Collection([
                    new Point('type', 'baby')
                ]),
                'five' => new Collection([
                    new Point('type', 'baby')
                ])
            ]),
            new Set([
                'one' => new Collection([
                    new Point('age', 3)
                ]),
                'two' => new Collection([
                    new Point('age', 4)
                ]),
                'three' => new Collection([
                    new Point('age', 5)
                ]),
                'four' => new Collection([
                    new Point('age', 1)
                ]),
                'five' => new Collection([
                    new Point('age', 1)
                ]),
                'six' => new Collection([
                    new Point('age', 2)
                ])
            ]),
            new Collection([
                new Point('age', 2)
            ], 'six'),
            Point::named('type')
        );

        $this->assertSame('five', $res->getKey());
    }

}