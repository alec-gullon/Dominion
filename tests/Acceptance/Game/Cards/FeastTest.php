<?php

namespace Tests\Acceptance\Game\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class FeastTest extends AcceptanceTestBase
{
    public function testFeast() {
        $this->buildGame();
        $this->setHand(['feast', 'copper@4']);
        $this->playCard('feast');

        $this->provideInput('duchy');

        $this->assertTrashSize(1);
        $this->assertDiscardSize(1);
        $this->assertNumberOfRemainingCards('duchy', 7);

        $this->assertLogContains([
            '.. Alec trashes the Feast',
            '.. Alec gains a Duchy'
        ]);
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

        $this->assertLogContains([
            '.. Alec gains a Duchy'
        ]);
        $this->assertLogDoesNotContain([
            '.. Alec trashes a Feast'
        ]);
    }

    public function testCannotAcquireProvince() {
        $this->buildGame();
        $this->setHand(['feast', 'copper@4']);
        $this->playCard('feast');

        $this->provideInput('gold');

        $this->assertTrashSize(0);
        $this->assertDiscardSize(0);
        $this->assertNumberOfRemainingCards('gold', 10);
    }


}
