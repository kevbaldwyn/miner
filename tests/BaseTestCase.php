<?php namespace KevBaldwyn\Tests\Miner;

use KevBaldwyn\Miner\Data\Collection;
use KevBaldwyn\Miner\Data\Point;

class BaseTestCase extends \PHPUnit_Framework_TestCase {

    protected function data($key = null, $set = 0)
    {
        $data = [
            // song ratings
            [
                'angelica' => new Collection([
                    new Point('Blues Traveler', 3.5),
                    new Point('Broken Bells', 2.0),
                    new Point('Norah Jones', 4.5),
                    new Point('Phoenix', 5.0),
                    new Point('Slightly Stoopid', 1.5),
                    new Point('The Strokes', 2.5),
                    new Point('Vampire Weekend', 2.0)
                ]),
                'hailey' => new Collection([
                    new Point('Broken Bells', 4.0),
                    new Point('Deadmau5',  1.0),
                    new Point('Norah Jones', 4.0),
                    new Point('The Strokes', 4.0),
                    new Point('Vampire Weekend', 1.0)
                ]),
                'veronica' => new Collection([
                    new Point('Blues Traveler', 3.0),
                    new Point('Norah Jones', 5.0),
                    new Point('Phoenix', 4.0),
                    new Point('Slightly Stoopid', 2.5),
                    new Point('The Strokes',  3.0)
                ]),
                'bill' => new Collection([
                    new Point('Blues Traveler', 2.0),
                    new Point('Broken Bells', 3.5),
                    new Point('Deadmau5', 4.0),
                    new Point('Phoenix', 2.0),
                    new Point('Slightly Stoopid', 3.5),
                    new Point('Vampire Weekend', 3.0)
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
            // song ratings 2
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
            // salary
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
            ],
            // song attributes
            [
                'Dr Dog/Fate' => new Collection([
                    new Point('piano', 2.5),
                    new Point('vocals', 4),
                    new Point('beat', 3.5),
                    new Point('blues', 3),
                    new Point('guitar', 5),
                    new Point('backup vocals', 4),
                    new Point('rap', 1)
                ]),
                'Phoenix/Lisztomania' => new Collection([
                    new Point('piano', 2),
                    new Point('vocals', 5),
                    new Point('beat', 5),
                    new Point('blues', 3),
                    new Point('guitar', 2),
                    new Point('backup vocals', 1),
                    new Point('rap', 1)
                ]),
                'Heartless Bastards/Out at Sea' => new Collection([
                    new Point('piano', 1),
                    new Point('vocals', 5),
                    new Point('beat', 4),
                    new Point('blues', 2),
                    new Point('guitar', 4),
                    new Point('backup vocals', 1),
                    new Point('rap', 1)
                ]),
                'Todd Snider/Don\'t Tempt Me' => new Collection([
                    new Point('piano', 4),
                    new Point('vocals', 5),
                    new Point('beat', 4),
                    new Point('blues', 4),
                    new Point('guitar', 1),
                    new Point('backup vocals', 5),
                    new Point('rap', 1)
                ]),
                'The Black Keys/Magic Potion' => new Collection([
                    new Point('piano', 1),
                    new Point('vocals', 4),
                    new Point('beat', 5),
                    new Point('blues', 3.5),
                    new Point('guitar', 5),
                    new Point('backup vocals', 1),
                    new Point('rap', 1)
                ]),
                'Glee Cast/Jessie\'s Girl' => new Collection([
                    new Point('piano', 1),
                    new Point('vocals', 5),
                    new Point('beat', 3.5),
                    new Point('blues', 3),
                    new Point('guitar', 4),
                    new Point('backup vocals', 5),
                    new Point('rap', 1)
                ]),
                'La Roux/Bulletproof' => new Collection([
                    new Point('piano', 5),
                    new Point('vocals', 5),
                    new Point('beat', 4),
                    new Point('blues', 2),
                    new Point('guitar', 1),
                    new Point('backup vocals', 1),
                    new Point('rap', 1)
                ]),
                'Mike Posner' => new Collection([
                    new Point('piano', 2.5),
                    new Point('vocals', 4),
                    new Point('beat', 4),
                    new Point('blues', 1),
                    new Point('guitar', 1),
                    new Point('backup vocals', 1),
                    new Point('rap', 1)
                ]),
                'Black Eyed Peas/Rock That Body' => new Collection([
                    new Point('piano', 2),
                    new Point('vocals', 5),
                    new Point('beat', 5),
                    new Point('blues', 1),
                    new Point('guitar', 2),
                    new Point('backup vocals', 2),
                    new Point('rap', 4)
                ]),
                'Lady Gaga/Alejandro' => new Collection([
                    new Point('piano', 1),
                    new Point('vocals', 5),
                    new Point('beat', 3),
                    new Point('blues', 2),
                    new Point('guitar', 1),
                    new Point('backup vocals', 2),
                    new Point('rap', 1)
                ])
            ],
            // peoples classifications of above songs
            [
                'angelica' => [
                    'Dr Dog/Fate' => new Collection([
                        new Point('like', 'L')
                    ]),
                    'Phoenix/Lisztomania' => new Collection([
                        new Point('like', 'L')
                    ]),
                    'Heartless Bastards/Out at Sea' => new Collection([
                        new Point('like', 'D')
                    ]),
                    'Todd Snider/Don\'t Tempt Me' => new Collection([
                        new Point('like', 'D')
                    ]),
                    'The Black Keys/Magic Potion' => new Collection([
                        new Point('like', 'D')
                    ]),
                    'Glee Cast/Jessie\'s Girl' => new Collection([
                        new Point('like', 'L')
                    ]),
                    'La Roux/Bulletproof' => new Collection([
                        new Point('like', 'D')
                    ]),
                    'Mike Posner' => new Collection([
                        new Point('like', 'D')
                    ]),
                    'Black Eyed Peas/Rock That Body' => new Collection([
                        new Point('like', 'D')
                    ]),
                    'Lady Gaga/Alejandro' => new Collection([
                        new Point('like', 'L')
                    ])
                ],
                'bill' => [
                    'Dr Dog/Fate' => new Collection([
                        new Point('like', 'L')
                    ]),
                    'Phoenix/Lisztomania' => new Collection([
                        new Point('like', 'L')
                    ]),
                    'Heartless Bastards/Out at Sea' => new Collection([
                        new Point('like', 'L')
                    ]),
                    'Todd Snider/Don\'t Tempt Me' => new Collection([
                        new Point('like', 'D')
                    ]),
                    'The Black Keys/Magic Potion' => new Collection([
                        new Point('like', 'L')
                    ]),
                    'Glee Cast/Jessie\'s Girl' => new Collection([
                        new Point('like', 'D')
                    ]),
                    'La Roux/Bulletproof' => new Collection([
                        new Point('like', 'D')
                    ]),
                    'Mike Posner' => new Collection([
                        new Point('like', 'D')
                    ]),
                    'Black Eyed Peas/Rock That Body' => new Collection([
                        new Point('like', 'D')
                    ]),
                    'Lady Gaga/Alejandro' => new Collection([
                        new Point('like', 'D')
                    ])
                ]
            ],
            // sports people
            [
                'Asuka Teramoto' => new Collection([
                    new Point('age', 16),
                    new Point('height', 54),
                    new Point('weight', 66),
                ]),
                'Brittainey Raven' => new Collection([
                    new Point('age', 22),
                    new Point('height', 72),
                    new Point('weight', 162),
                ]),
                'Chen Nan' => new Collection([
                    new Point('age', 30),
                    new Point('height', 78),
                    new Point('weight', 204),
                ]),
                'Gabby Douglas' => new Collection([
                    new Point('age', 16),
                    new Point('height', 49),
                    new Point('weight', 90),
                ]),
                'Helalia Johannes' => new Collection([
                    new Point('age', 32),
                    new Point('height', 65),
                    new Point('weight', 99),
                ]),
                'Irina Miketenko' => new Collection([
                    new Point('age', 40),
                    new Point('height', 63),
                    new Point('weight', 106),
                ]),
                'Jennifer Lacy' => new Collection([
                    new Point('age', 27),
                    new Point('height', 75),
                    new Point('weight', 175),
                ]),
                'Kara Goucher' => new Collection([
                    new Point('age', 34),
                    new Point('height', 67),
                    new Point('weight', 123),
                ]),
                'Linlin Deng' => new Collection([
                    new Point('age', 16),
                    new Point('height', 54),
                    new Point('weight', 68),
                ]),
                'Nakia Sanford' => new Collection([
                    new Point('age', 34),
                    new Point('height', 76),
                    new Point('weight', 200),
                ]),
                'Nikki Blue' => new Collection([
                    new Point('age', 26),
                    new Point('height', 68),
                    new Point('weight', 163),
                ]),
                'Qiushuang Huang' => new Collection([
                    new Point('age', 20),
                    new Point('height', 61),
                    new Point('weight', 95),
                ]),
                'Rebecca Tunney' => new Collection([
                    new Point('age', 16),
                    new Point('height', 58),
                    new Point('weight', 77),
                ]),
                'Rene Kalmer' => new Collection([
                    new Point('age', 32),
                    new Point('height', 70),
                    new Point('weight', 108),
                ]),
                'Shanna Crossley' => new Collection([
                    new Point('age', 26),
                    new Point('height', 70),
                    new Point('weight', 155),
                ]),
                'Shavonte Zellous' => new Collection([
                    new Point('age', 24),
                    new Point('height', 70),
                    new Point('weight', 155),
                ]),
                'Tatyana Petrova' => new Collection([
                    new Point('age', 29),
                    new Point('height', 63),
                    new Point('weight', 108),
                ]),
                'Tiki Gelana' => new Collection([
                    new Point('age', 25),
                    new Point('height', 65),
                    new Point('weight', 106),
                ]),
                'Valeria Straneo' => new Collection([
                    new Point('age', 36),
                    new Point('height', 66),
                    new Point('weight', 97),
                ]),
                'Viktoria Komova' => new Collection([
                    new Point('age', 17),
                    new Point('height', 61),
                    new Point('weight', 76),
                ]),
            ]
        ];

        if(!is_null($key)) {
            return $data[$set][$key];
        }else{
            return $data[$set];
        }
    }

}