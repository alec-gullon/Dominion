<?php

namespace Tests\Acceptance\Game\Cards;

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

        $this->assertLogContains([
            '.. Alec trashes two Estates'
        ]);
    }

    public function testWithEmptyHand() {
        $this->buildGame();
        $this->setHand(['chapel']);
        $this->playCard('chapel');

        $this->assertHandSize(0);
        $this->assertNumberOfPlayed(1);
        $this->assertActions(0);
        $this->assertAllCardsResolved();

        $this->assertLogContains([
            '.. Alec has nothing to trash'
        ]);
    }

    public function testUserSelectsNothing() {
        $this->buildGame();
        $this->setHand(['chapel', 'copper@2', 'estate@2']);
        $this->playCard('chapel');
        $this->provideInput(array());
        $this->assertHandSize(4);
        $this->assertTrashSize(0);

        $this->assertLogContains([
            '.. Alec trashes nothing'
        ]);
    }
}
