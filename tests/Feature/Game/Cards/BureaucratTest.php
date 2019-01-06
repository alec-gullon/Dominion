<?php

namespace Tests\Feature\Game\Cards;

class BureaucratTest extends CardTestBase
{
    public function testWithNoVictoryCardsInHand() {
        $this->buildGame();
        $this->setHand(['bureaucrat', 'copper@4']);
        $this->setOpponentHand(['copper@5']);
        $this->playCard('bureaucrat');

        $this->assertDeckSize(6);
        $this->assertAllCardsResolved();
    }

    public function testWithEstateInHand() {
        $this->buildGame();
        $this->setHand(['bureaucrat', 'copper@4']);
        $this->playCard('bureaucrat');
        $this->provideInput('estate');

        $this->assertDeckSize(6);
        $this->assertOpponentHandSize(4);
        $this->assertOpponentDeckSize(6);
    }

    public function testWithMoat() {
        $this->buildGameWithMoat();
        $this->setHand(['bureaucrat', 'copper@4']);
        $this->setOpponentHand(['moat', 'copper@4']);
        $this->playCard('bureaucrat');

        $this->provideInput(true);
        $this->assertDeckSize(6);
        $this->assertOpponentHandSize(5);
        $this->assertOpponentHandSize(5);
    }

    public function testNoSilversInKingdom() {
        $this->buildGameWithMoat();
        $this->setNumberOfCardsRemaining('silver', 0);

        $this->setHand(['bureaucrat', 'copper@4']);
        $this->playCard('bureaucrat');
        $this->provideInput('estate');

        $this->assertNumberOfRemainingCards('silver', 0);
        $this->assertDeckSize(5);
    }
}
