<?php

namespace Tests\Unit\Game\Models;

use App\Game\Models\Log;
use Tests\TestCase;

class LogTest extends TestCase
{
    public function testReversedOrderEntries()
    {
        $log = new Log();

        $log->entries = [
            1 => [
                'Alec plays a Village',
                '.. Alec draws 2 cards',
                '.. Alec gains an action',
                'Alec ends their turn'
            ],
            2 => [
                'Marvin plays a Smithy',
                '.. Marvin draws 3 cards',
                'Marvin plays 3 coppers and a silver',
                'Marvin ends their turn'
            ]
        ];

        $reversedEntries = $log->reversedEntries();

        $this->assertEquals($reversedEntries, [
            1 => [
                'Alec ends their turn',
                'Alec plays a Village',
                '.. Alec draws 2 cards',
                '.. Alec gains an action',
            ],
            2 => [
                'Marvin ends their turn',
                'Marvin plays 3 coppers and a silver',
                'Marvin plays a Smithy',
                '.. Marvin draws 3 cards'
            ]
        ]);
    }
}
