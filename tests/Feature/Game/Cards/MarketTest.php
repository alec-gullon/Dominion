<?php

namespace Tests\Feature\Game\Cards;

class MarketTest extends CardTestBase
{
    public function testFestival()
    {
        $this->buildGame();
        $this->setHand(['market', 'copper@4']);
        $this->playCard('market');
        $this->assertHandSize(5);
        $this->assertActions(1);
        $this->assertNumberOfBuys(2);
        $this->assertNumberOfCoins(1);
    }
}
