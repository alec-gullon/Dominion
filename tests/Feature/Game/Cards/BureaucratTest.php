<?php

namespace Tests\Feature\Game\Cards;

class BureaucratTest extends CardTestBase
{
    public function testBureaucratWithNoVictoryCardsInHand() {
        $this->buildGame();
        $this->setHand(['bureaucrat', 'copper@4']);
        $this->setOpponentHand(['copper@5']);
        $this->playCard('bureaucrat');

        $this->assertDeckSize(6);
        $this->assertAllCardsResolved();
    }

    public function testBureaucratWithEstateInHand() {
        $this->buildGame();
        $this->setHand(['bureaucrat', 'copper@4']);
        $this->playCard('bureaucrat');
        $this->provideInput('estate');

        $this->assertDeckSize(6);
        $this->assertOpponentHandSize(4);
        $this->assertOpponentDeckSize(6);
    }

    public function testBureaucratWithMoat() {
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

    }
}
