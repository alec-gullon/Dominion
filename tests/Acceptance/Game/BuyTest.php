<?php

namespace Tests\Acceptance\Game;

class BuyTest extends GameTestBase
{
    public function testBuy()
    {
        $this->buildGame();
        $this->playTreasure('copper');
        $this->playTreasure('copper');
        $this->postUpdate('advance-to-buy');
        $this->postUpdate('buy', 'estate');

        $this->assertPhase('buy');
        $this->assertDiscardSize(1);
        $this->assertNumberOfCoins(0);
        $this->assertHandSize(3);
        $this->assertNumberOfPlayed(2);

        $this->assertLogContains([
            '.. Alec buys an Estate'
        ]);
    }
}
