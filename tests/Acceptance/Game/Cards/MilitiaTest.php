<?php

namespace Tests\Acceptance\Game\Cards;

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

        $this->assertLogContains([
            '.. Alec gains two coins',
            '.. Lucy discards a Copper and an Estate from their hand'
        ]);
    }

    public function testWithMoat() {
        $this->buildGameWithMoat();
        $this->setHand(['militia', 'copper@4']);
        $this->setOpponentHand(['moat', 'copper@4']);
        $this->playCard('militia');
        $this->provideInput(true);

        $this->assertNumberOfCoins(2);
        $this->assertOpponentHandSize(5);
        $this->assertOpponentDiscardSize(0);
        $this->assertAllCardsResolved();

        $this->assertLogContains([
            '.. Lucy reveals a Moat'
        ]);
        $this->assertLogCountEquals(3);
    }

    public function testWithLessThanThreeCards() {
        $this->buildGame();
        $this->setHand(['militia', 'copper@4']);
        $this->setOpponentHand(['copper@3']);
        $this->playCard('militia');

        $this->assertNumberOfCoins(2);
        $this->assertOpponentHandSize(3);
        $this->assertAllCardsResolved();

        $this->assertLogContains([
            '.. Lucy is unaffected since they have three cards in hand'
        ]);
        $this->assertLogCountEquals(3);
    }

    public function testWithMoreThanFiveCards() {
        $this->buildGame();
        $this->setHand(['militia', 'copper@4']);
        $this->setOpponentHand(['copper@6']);
        $this->playCard('militia');

        $this->provideInput(['copper', 'copper', 'copper']);
        $this->assertOpponentHandSize(3);

        $this->assertLogContains([
            '.. Lucy discards three Coppers from their hand'
        ]);
    }

    public function testCannotDiscardLessThanRequiredCards() {
        $this->buildGame();
        $this->setHand(['militia', 'copper@4']);
        $this->playCard('militia');
        $this->provideInput(['estate']);

        $this->assertNumberOfCoins(2);
        $this->assertOpponentHandSize(5);
        $this->assertOpponentDiscardSize(0);
    }
}
