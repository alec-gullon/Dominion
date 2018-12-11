<?php

namespace Tests\Feature\Game\Cards;

class MilitiaTest extends CardTestBase
{
    public function testMilitia() {
        $this->buildGame();
        $this->setHand(['militia', 'copper@4']);
        $this->playCard('militia');
        $this->provideInput(['estate', 'copper']);

        $this->assertNumberOfCoins(2);
        $this->assertOpponentHandSize(3);
        $this->assertOpponentDiscardSize(2);
    }

    public function testMilitiaWithMoat() {
        $this->buildGameWithMoat();
        $this->setHand(['militia', 'copper@4']);
        $this->setOpponentHand(['moat', 'copper@4']);
        $this->playCard('militia');
        $this->provideInput(true);

        $this->assertNumberOfCoins(2);
        $this->assertOpponentHandSize(5);
        $this->assertOpponentDiscardSize(0);
        $this->assertAllCardsResolved();
    }

    public function testMilitiaWithLessThanThreeCards() {
        $this->buildGame();
        $this->setHand(['militia', 'copper@4']);
        $this->setOpponentHand(['copper@3']);
        $this->playCard('militia');

        $this->assertNumberOfCoins(2);
        $this->assertOpponentHandSize(3);
        $this->assertAllCardsResolved();
    }
}
