<?php

namespace Tests\Feature\Game\Cards;

class SpyTest extends CardTestBase
{
    public function testSpy() {
        $this->buildGame();
        $this->setDeck(['copper@4', 'estate@1']);
        $this->setHand(['spy', 'copper@4']);
        $this->setOpponentDeck(['copper@5']);
        $this->setOpponentHand(['copper@2', 'estate@3']);
        $this->playCard('spy');

        $this->assertHandSize(5);
        $this->assertActions(1);

        $this->provideInput(true);

        $this->assertDeckSize(3);

        $this->provideInput(false);

        $this->assertOpponentDeckSize(5);
    }
}
