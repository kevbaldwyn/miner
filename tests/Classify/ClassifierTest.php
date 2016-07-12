<?php namespace KevBaldwyn\Tests\Miner\Classify;

use KevBaldwyn\Miner\Classify\Classifier;
use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Data\Set;
use KevBaldwyn\Tests\Miner\BaseTestCase;

class ClassifierTest extends BaseTestCase {

    public function test_classify()
    {
        $c = new Classifier(new Set(self::data(null, 3)));

        $res = $c->classify(
            new Set(self::data('angelica', 4)), // use Angelica's data set to classify
            new Collection([
                new Point('piano', 1),
                new Point('vocals', 5),
                new Point('beat', 2.5),
                new Point('blues', 1),
                new Point('guitar', 1),
                new Point('backup vocals', 5),
                new Point('rap', 1)
            ], 'Chris Cagle/ I Breathe In. I Breathe Out'),
            Point::named('like')
        );

        $this->assertSame('L', $res->getValue());
    }

}