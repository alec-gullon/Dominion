<?php

namespace Tests\Acceptance\Game\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class WoodcutterTest extends AcceptanceTestBase
{
    public function testWoodcutter()
    {
        $this->buildGame();
        $this->setHand(['woodcutter', 'copper@4']);
        $this->playCard('woodcutter');
        $this->assertHandSize(4);
        $this->assertNumberOfCoins(2);
        $this->assertNumberOfBuys(2);

        $this->assertLogContains([
            '.. Alec gains two coins',
            '.. Alec gains a buy'
        ]);
    }
}
