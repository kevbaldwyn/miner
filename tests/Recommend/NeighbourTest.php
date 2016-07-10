<?php namespace KevBaldwyn\Tests\Miner\Recommend;

use KevBaldwyn\Miner\Data\Set;
use KevBaldwyn\Miner\Recommend\Neighbour;
use KevBaldwyn\Miner\Strategy\Distance\Manhattan;
use KevBaldwyn\Miner\Strategy\Distance\Minkowski;
use KevBaldwyn\Miner\Strategy\Similarity\Cosine;
use KevBaldwyn\Miner\Strategy\Similarity\Pearson;
use KevBaldwyn\Tests\Miner\BaseTestCase;

class NeighbourTest extends BaseTestCase {

    public function test_getNearestNeighbour()
    {
        $this->assertSame('veronica', (new Neighbour(new Set(self::data()), new Manhattan()))->getNearestNeighbour('angelica')->first()->getKey());
        $this->assertSame('veronica', (new Neighbour(new Set(self::data()), new Minkowski()))->getNearestNeighbour('angelica')->first()->getKey());
        $this->assertSame('veronica', (new Neighbour(new Set(self::data()), new Cosine()))->getNearestNeighbour('angelica')->first()->getKey());
        $this->assertSame('veronica', (new Neighbour(new Set(self::data()), new Pearson()))->getNearestNeighbour('angelica')->first()->getKey());
    }

    public function test_recommend()
    {
        $recommender = new Neighbour(new Set(self::data()), new Pearson());
        $recommendations = $recommender->recommend('hailey');

        $this->assertSame('Phoenix', $recommendations->first()->getKey());
        $this->assertSame(5.0, $recommendations->first()->getValue());

        $this->assertSame('Slightly Stoopid', $recommendations->last()->getKey());
        $this->assertSame(4.5, $recommendations->last()->getValue());
    }
}