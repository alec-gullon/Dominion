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

        $this->assertLogContains([
            '.. Alec gains a Silver, putting it on top of their deck',
            '.. Lucy reveals a hand of five Coppers'
        ]);
    }

    public function testWithEstateInHand() {
        $this->buildGame();
        $this->setHand(['bureaucrat', 'copper@4']);
        $this->playCard('bureaucrat');
        $this->provideInput('estate');

        $this->assertDeckSize(6);
        $this->assertOpponentHandSize(4);
        $this->assertOpponentDeckSize(6);

        $this->assertLogContains([
            '.. Lucy places an Estate onto their deck from their hand'
        ]);
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

        $this->assertLogContains([
            '.. Lucy reveals a Moat'
        ]);
    }

    public function testNoSilversInKingdom() {
        $this->buildGameWithMoat();
        $this->setNumberOfCardsRemaining('silver', 0);

        $this->setHand(['bureaucrat', 'copper@4']);
        $this->playCard('bureaucrat');
        $this->provideInput('estate');

        $this->assertNumberOfRemainingCards('silver', 0);
        $this->assertDeckSize(5);

        $this->assertLogContains([
            '.. Alec places nothing on their deck'
        ]);
    }
}
