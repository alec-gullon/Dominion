<?php

namespace Tests\Feature\Game\Cards;

class WoodcutterTest extends CardTestBase
{
    public function testFestival()
    {
        $this->buildGame();
        $this->setHand(['woodcutter', 'copper@4']);
        $this->playCard('woodcutter');
        $this->assertHandSize(4);
        $this->assertNumberOfCoins(2);
        $this->assertNumberOfBuys(2);
    }
}
