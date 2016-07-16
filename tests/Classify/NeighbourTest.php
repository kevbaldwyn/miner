<?php namespace KevBaldwyn\Tests\Miner\Classify;

use KevBaldwyn\Miner\Classify\Neighbour;
use KevBaldwyn\Miner\Classify\NeighbourMethod\NearestNeighbour;
use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Data\Set;
use KevBaldwyn\Tests\Miner\BaseTestCase;

class ClassifierTest extends BaseTestCase {

    public function test_classify_standard()
    {
        $c = new Neighbour(
            new Set(self::data(null, 3)),
            new NearestNeighbour(
                new Set(self::data('angelica', 4)), // use Angelica's data set to classify
                false
            )
        );

        $res = $c->classify(
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

    public function test_classify_normalised()
    {
        $c = new Neighbour(
            new Set(self::data(null, 5)),
            new NearestNeighbour(
                new Set(self::data(null, 6)),
                true
            )
        );

        // first classification (correct)
        $res = $c->classify(
            new Collection([
                new Point('weight', 74),
                new Point('height', 190)
            ], 'Crystal Langhorne'),
            Point::named('sport')
        );
        $this->assertSame('Basketball', $res->getValue());

        // second classification (incorrect)
        $res = $c->classify(
            new Collection([
                new Point('weight', 62),
                new Point('height', 115)
            ], 'Aly Raisman'),
            Point::named('sport')
        );

        // this is actually an incorrect classification
        // we expect the classifier to get this wrong
        $this->assertSame('Track', $res->getValue());
    }

}