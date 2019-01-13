<?php

namespace Tests\Acceptance\Game\Cards;

class MarketTest extends CardTestBase
{
    public function testMarket()
    {
        $this->buildGame();
        $this->setHand(['market', 'copper@4']);
        $this->playCard('market');
        $this->assertHandSize(5);
        $this->assertActions(1);
        $this->assertNumberOfBuys(2);
        $this->assertNumberOfCoins(1);

        $this->assertLogContains([
            '.. Alec gains an action',
            '.. Alec draws a card',
            '.. Alec gains a buy',
            '.. Alec gains a coin'
        ]);
    }
}
