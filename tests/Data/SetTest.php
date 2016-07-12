<?php namespace KevBaldwyn\Tests\Miner\Data;

use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Data\Set;
use KevBaldwyn\Tests\Miner\BaseTestCase;

class SetTest extends BaseTestCase {

    public function test_exclude()
    {
        $set = new Set([
            'p1' => new Collection([
                new Point('One', 1),
                new Point('Two', 2)
            ]),
            'p2' => new Collection([
                new Point('Three', 3),
                new Point('Four', 4)
            ])
        ]);

        $newSet = $set->exclude('p1');

        $this->assertCount(1, $newSet);
        $this->assertTrue($newSet->has('p2'));
    }

    public function test_getDeviations()
    {
        $set = new Set(self::data(null, 1));
        $deviations = $set->getDeviations();

        $this->assertSame([
            'Taylor Swift' => [
                'PSY' => 4,
                'Whitney Houston' => 2
            ],
            'PSY' => [
                'Taylor Swift' => -4,
                'Whitney Houston' => -1.5
            ],
            'Whitney Houston' => [
                'Taylor Swift' => -2,
                'PSY' => 1.5
            ]
        ], $deviations);
    }

    public function test_getFrequencies()
    {
        $set = new Set(self::data(null, 1));
        $frequencies = $set->getFrequencies();

        $this->assertSame([
            'Taylor Swift' => [
                'PSY' => 2,
                'Whitney Houston' => 2
            ],
            'PSY' => [
                'Taylor Swift' => 2,
                'Whitney Houston' => 2
            ],
            'Whitney Houston' => [
                'Taylor Swift' => 2,
                'PSY' => 2
            ]
        ], $frequencies);
    }
}