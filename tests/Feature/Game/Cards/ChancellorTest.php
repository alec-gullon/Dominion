<?php

namespace Tests\Feature\Game\Cards;

class ChancellorTest extends CardTestBase
{
    public function testChancellor()
    {
        $this->buildGame();
        $this->setHand(['cellar', 'copper@2', 'estate@2']);
        $this->playCard('cellar');

        $this->assertHandSize(4);
        $this->assertNumberOfPlayed(1);
        $this->assertActions(1);

        $this->provideInput(array('estate', 'estate'));

        $this->assertHandSize(4);
        $this->assertDeckSize(3);
    }

    public function testNotPutDeckInDiscard() {

    }

    public function testDiscardNonEmpty() {

    }
}
