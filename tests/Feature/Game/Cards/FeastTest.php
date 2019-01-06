<?php

namespace Tests\Feature\Game\Cards;

class FeastTest extends CardTestBase
{
    public function testFeast() {
        $this->buildGame();
        $this->setHand(['feast', 'copper@4']);
        $this->playCard('feast');

        $this->assertTrashSize(1);

        $this->provideInput('duchy');

        $this->assertDiscardSize(1);
        $this->assertNumberOfRemainingCards('duchy', 7);
    }

    public function testVirtualCardNotTrashed() {
        $this->buildGame();
        $this->setHand(['feast', 'copper@4']);
        $this->playVirtualCard('feast');

        $this->assertTrashSize(0);

        $this->provideInput('duchy');

        $this->assertDiscardSize(1);
        $this->assertNumberOfPlayed(1);
        $this->assertAllCardsResolved();
        $this->assertNumberOfRemainingCards('duchy', 7);
    }


}
