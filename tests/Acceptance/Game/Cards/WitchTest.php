<?php

namespace Tests\Acceptance\Game\Cards;

class WitchTest extends CardTestBase
{
    public function testWitch() {
        $this->buildGame();
        $this->setHand(['witch', 'copper@4']);
        $this->playCard('witch');

        $this->assertHandSize(6);
        $this->assertNumberOfPlayed(1);
        $this->assertActions(0);
        $this->assertNumberOfRemainingCards('curse', 9);
        $this->assertOpponentDiscardSize(1);

        $this->assertLogContains([
            '.. Alec draws two cards',
            '.. Lucy gains a Curse'
        ]);
    }

    public function testWitchWithMoat() {
        $this->buildGameWithMoat();
        $this->setHand(['witch', 'copper@4']);
        $this->setOpponentHand(['moat', 'copper@4']);
        $this->playCard('witch');

        $this->assertHandSize(6);
        $this->assertNumberOfPlayed(1);
        $this->assertActions(0);

        $this->provideInput(true);

        $this->assertNumberOfRemainingCards('curse', 10);
        $this->assertOpponentDiscardSize(0);

        dd($this->log());

        $this->assertLogContains([
            '.. Alec draws two cards',
            '.. Lucy reveals a Moat'
        ]);
    }

    public function testEmptyCursePile() {
        $this->buildGame();
        $this->setHand(['witch', 'copper@4']);
        $this->setNumberOfCardsRemaining('curse', 0);
        $this->playCard('witch');

        $this->assertOpponentHandSize(5);
        $this->assertNumberOfRemainingCards('curse', 0);

        $this->assertLogContains([
            '.. Lucy gains nothing since Curse pile is empty'
        ]);
    }
}
