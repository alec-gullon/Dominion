<?php

namespace Tests\Feature\Game\Cards;

class ChapelTest extends CardTestBase
{
    public function testChapel() {
        $this->buildGame();
        $this->setHand(['chapel', 'copper@2', 'estate@2']);
        $this->playCard('chapel');
        $this->assertHandSize(4);
        $this->assertNumberOfPlayed(1);
        $this->assertActions(0);

        $this->provideInput(array('estate', 'estate'));
        $this->assertHandSize(2);
        $this->assertTrashSize(2);
    }

    public function testChapelWithEmptyHand() {
        $this->buildGame();
        $this->setHand(['chapel']);
        $this->playCard('chapel');

        $this->assertHandSize(0);
        $this->assertNumberOfPlayed(1);
        $this->assertActions(0);
        $this->assertAllCardsResolved();
    }

    public function testUserSelectsNothing() {

    }
}
