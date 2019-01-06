<?php

namespace Tests\Feature\Game\Cards;

class CellarTest extends CardTestBase
{
    public function testCellar()
    {
        $this->buildGame();
        $this->setHand(['chancellor', 'copper@4']);
        $this->playCard('chancellor');
        $this->assertNumberOfCoins(2);

        $this->provideInput(true);
        $this->assertDiscardSize(5);
    }

    public function testCellarLastCardInHand() {

    }

    public function testEmptyDeck() {

    }

    public function testEmptyDeckAndDiscard() {

    }

    public function testDiscardMoreCardsInDeckAndDiscard() {

    }
}
