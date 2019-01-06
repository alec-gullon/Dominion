<?php

namespace Tests\Feature\Game\Cards;

class MoneylenderTest extends CardTestBase
{
    public function testMoneylender()
    {
        $this->buildGame();
        $this->setHand(['moneylender', 'copper@4']);
        $this->playCard('moneylender');
        $this->provideInput(true);

        $this->assertHandSize(3);
        $this->assertTrashSize(1);
        $this->assertNumberOfCoins(3);
    }

    public function testNoCoppersInHand() {
        $this->buildGame();
        $this->setHand(['moneylender', 'village@4']);
        $this->playCard('moneylender');

        $this->assertAllCardsResolved();
    }

    public function testDoesNotTrash() {
        $this->buildGame();
        $this->setHand(['moneylender', 'copper@4']);
        $this->playCard('moneylender');
        $this->provideInput(false);

        $this->assertHandSize(4);
        $this->assertTrashSize(0);
    }
}
