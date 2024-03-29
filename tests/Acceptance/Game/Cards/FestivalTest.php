<?php

namespace Tests\Acceptance\Game\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class FestivalTest extends AcceptanceTestBase
{
    public function testFestival()
    {
        $this->buildGame();
        $this->setHand(['festival', 'copper@4']);
        $this->playCard('festival');
        $this->assertHandSize(4);
        $this->assertActions(2);
        $this->assertNumberOfBuys(2);
        $this->assertNumberOfCoins(2);

        $this->assertLogContains([
            '.. Alec gains two coins',
            '.. Alec gains a buy',
            '.. Alec gains two actions'
        ]);
    }
}
