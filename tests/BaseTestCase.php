<?php namespace KevBaldwyn\Tests\Miner;

use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;

class BaseTestCase extends \PHPUnit_Framework_TestCase {

    protected function data($key = null, $set = 0)
    {
        $data = [
            [
                'angelica' => new Collection([
                    new Point("Blues Traveler", 3.5),
                    new Point("Broken Bells", 2.0),
                    new Point("Norah Jones", 4.5),
                    new Point("Phoenix", 5.0),
                    new Point("Slightly Stoopid", 1.5),
                    new Point("The Strokes", 2.5),
                    new Point("Vampire Weekend", 2.0)
                ]),
                'hailey' => new Collection([
                    new Point("Broken Bells", 4.0),
                    new Point("Deadmau5",  1.0),
                    new Point("Norah Jones", 4.0),
                    new Point("The Strokes", 4.0),
                    new Point("Vampire Weekend", 1.0)
                ]),
                'veronica' => new Collection([
                    new Point("Blues Traveler", 3.0),
                    new Point("Norah Jones", 5.0),
                    new Point("Phoenix", 4.0),
                    new Point("Slightly Stoopid", 2.5),
                    new Point("The Strokes",  3.0)
                ]),
                'bill' => new Collection([
                    new Point("Blues Traveler", 2.0),
                    new Point("Broken Bells", 3.5),
                    new Point("Deadmau5", 4.0),
                    new Point("Phoenix", 2.0),
                    new Point("Slightly Stoopid", 3.5),
                    new Point("Vampire Weekend", 3.0)
                ]),
                'chan' => new Collection([
                    new Point('Blues Traveler', 5.0),
                    new Point('Broken Bells', 1.0),
                    new Point('Deadmau5', 1.0),
                    new Point('Norah Jones', 3.0),
                    new Point('Phoenix', 5),
                    new Point('Slightly Stoopid', 1.0)
                ]),
                'dan' => new Collection([
                    new Point('Blues Traveler', 3.0),
                    new Point('Broken Bells', 4.0),
                    new Point('Deadmau5', 4.5),
                    new Point('Phoenix', 3.0),
                    new Point('Slightly Stoopid', 4.5),
                    new Point('The Strokes', 4.0),
                    new Point('Vampire Weekend', 2.0)
                ]),
                'sam' => new Collection([
                    new Point('Blues Traveler', 5.0),
                    new Point('Broken Bells', 2.0),
                    new Point('Norah Jones', 3.0),
                    new Point('Phoenix', 5.0),
                    new Point('Slightly Stoopid', 4.0),
                    new Point('The Strokes', 5.0)
                ]),
                'jordyn' => new Collection([
                    new Point('Broken Bells', 4.5),
                    new Point('Deadmau5', 4.0),
                    new Point('Norah Jones', 5.0),
                    new Point('Phoenix', 5.0),
                    new Point('Slightly Stoopid', 4.5),
                    new Point('The Strokes', 4.0),
                    new Point('Vampire Weekend', 4.0)
                ])
            ],
            [
                'amy' => new Collection([
                    new Point('Taylor Swift', 4),
                    new Point('PSY', 3),
                    new Point('Whitney Houston', 4)
                ]),
                'ben' => new Collection([
                    new Point('Taylor Swift', 5),
                    new Point('PSY', 2)
                ]),
                'clara' => new Collection([
                    new Point('PSY', 3.5),
                    new Point('Whitney Houston', 4)
                ]),
                'daisy' => new Collection([
                    new Point('Taylor Swift', 5),
                    new Point('Whitney Houston', 3)
                ])
            ],
            [
                'Michael W' => new Collection([
                    new Point('salary', 43000)
                ]),
                'Daniela C' => new Collection([
                    new Point('salary', 45000)
                ]),
                'Allie C' => new Collection([
                    new Point('salary', 55000)
                ]),
                'David A' => new Collection([
                    new Point('salary', 69000)
                ]),
                'Brian A' => new Collection([
                    new Point('salary', 70000)
                ]),
                'Yun L' => new Collection([
                    new Point('salary', 75000)
                ]),
                'Abdullah K' => new Collection([
                    new Point('salary', 105000)
                ]),
                'Rita A' => new Collection([
                    new Point('salary', 115000)
                ])
            ]
        ];

        if(!is_null($key)) {
            return $data[$set][$key];
        }else{
            return $data[$set];
        }
    }

}