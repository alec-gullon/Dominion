<?php

namespace Tests\Feature\Game\Cards;

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
    }
}
