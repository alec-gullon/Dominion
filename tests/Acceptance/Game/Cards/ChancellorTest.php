<?php

namespace Tests\Acceptance\Game\Cards;

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

        $this->assertLogContains([
            '.. Alec gains two coins',
            '.. Alec puts their deck into their discard'
        ]);
    }

    public function testNotPutDeckInDiscard() {
        $this->buildGame();
        $this->setHand(['chancellor', 'copper@4']);
        $this->playCard('chancellor');

        $this->provideInput(false);
        $this->assertDiscardSize(0);
        $this->assertDeckSize(5);

        $this->assertLogContains([
            '.. Alec does not put their deck into their discard'
        ]);
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
