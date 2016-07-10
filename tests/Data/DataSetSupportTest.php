<?php namespace KevBaldwyn\Tests\Miner\Data;

use KevBaldwyn\Miner\Data\DataSetSupport;
use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Data\Set;
use KevBaldwyn\Tests\Miner\BaseTestCase;

class DataSetSupportTest extends BaseTestCase {

    public function test_getValue()
    {
        $support = new DataSetSupport(new Set(self::data(null, 2)));
        $this->assertSame([
            43000,
            45000,
            55000,
            69000,
            70000,
            75000,
            105000,
            115000
        ], $support->getValues(new Point('salary', null)));
    }

    public function test_getAbsoluteStandardDeviation()
    {
        $support = new DataSetSupport(new Set(self::data(null, 2)));
        $this->assertSame(19125, (integer) $support->getAbsoluteStandardDeviation(new Point('salary', null)));
    }

    public function test_getModifiedStandardScoreFor()
    {
        $support = new DataSetSupport(new Set(self::data(null, 2)));
        $this->assertSame(0.2876, round($support->getModifiedStandardScoreFor(new Point('salary', 75000)), 4));
    }

}