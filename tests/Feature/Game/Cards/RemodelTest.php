<?php

namespace Tests\Feature\Game\Cards;

class RemodelTest extends CardTestBase
{
    public function testRemodel()
    {
        $this->buildGame();
        $this->setHand(['remodel', 'copper@2', 'estate@2']);
        $this->playCard('remodel');

        $this->assertHandSize(4);
        $this->assertNumberOfPlayed(1);
        $this->assertActions(0);

        $this->provideInput('estate');

        $this->assertHandSize(3);
        $this->assertTrashSize(1);

        $this->provideInput('silver');

        $this->assertDiscardSize(1);
        $this->assertNumberOfRemainingCards('silver', 19);
    }

    public function testEmptyHand() {

    }

    public function testTrashCurseNoCardsWorthLessThanTwoKingdom() {

    }
}
