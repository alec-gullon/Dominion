<?php

namespace Tests\Feature\Game\Cards;

class ChancellorTest extends CardTestBase
{
    public function testChancellor()
    {
        $this->buildGame();
        $this->setHand(['chancellor', 'copper@4']);
        $this->playCard('chancellor');
        $this->assertNumberOfCoins(2);

        $this->provideInput(true);
        $this->assertDiscardSize(5);
    }

    public function testNotPutDeckInDiscard() {
        $this->buildGame();
        $this->setHand(['chancellor', 'copper@4']);
        $this->playCard('chancellor');

        $this->provideInput(false);
        $this->assertDiscardSize(0);
        $this->assertDeckSize(5);
    }

    public function testDiscardNonEmpty() {
        $this->buildGame();
        $this->setHand(['chancellor', 'copper@4']);
        $this->setDiscard(['copper@3']);
        $this->playCard('chancellor');
        $this->assertNumberOfCoins(2);

        $this->provideInput(true);
        $this->assertDiscardSize(8);
        $this->assertDeckSize(0);
    }
}
