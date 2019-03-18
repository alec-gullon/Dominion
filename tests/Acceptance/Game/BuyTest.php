<?php

namespace Tests\Acceptance\Game;

use Tests\Acceptance\AcceptanceTestBase;

class BuyTest extends AcceptanceTestBase
{
    public function testBuy()
    {
        $this->buildGame();
        $this->playTreasure('copper');
        $this->playTreasure('copper');
        $this->update('advance-to-buy');
        $this->update('buy', 'estate');

        $this->assertPhase('buy');
        $this->assertDiscardSize(1);
        $this->assertNumberOfCoins(0);
        $this->assertHandSize(3);
        $this->assertNumberOfPlayed(2);

        $this->assertLogContains([
            'Alec buys an Estate'
        ]);
    }

    public function testValidatesSelectedCard() {
        $this->buildGame();
        $this->playTreasure('copper');
        $this->update('buy', 'estate');

        $this->assertNumberOfRemainingCards('estate', 8);
    }
}
