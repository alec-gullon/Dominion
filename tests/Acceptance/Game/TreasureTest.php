<?php

namespace Tests\Acceptance\Game;

use Tests\Acceptance\AcceptanceTestBase;

class TreasureTest extends AcceptanceTestBase
{
    public function testPlayTreasure()
    {
        $this->buildGame();
        $this->setHand(['copper', 'silver', 'gold']);
        $this->playTreasure('copper');

        $this->assertNumberOfCoins(1);
        $this->assertHandSize(2);
        $this->assertPhase('buy');
        $this->assertLogContains([
            '.. Alec plays a Copper'
        ]);

        $this->playTreasure('silver');

        $this->assertNumberOfCoins(3);
        $this->assertHandSize(1);
        $this->assertPhase('buy');
        $this->assertLogContains([
            '.. Alec plays a Silver'
        ]);

        $this->playTreasure('gold');

        $this->assertNumberOfCoins(6);
        $this->assertHandSize(0);
        $this->assertPhase('buy');
        $this->assertLogContains([
            '.. Alec plays a Gold'
        ]);
    }
}
