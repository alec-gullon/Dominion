<?php

namespace Tests\Feature\Game\Cards;

class FestivalTest extends CardTestBase
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
    }
}
