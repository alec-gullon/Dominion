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

        $this->assertLogContains([
            '.. Alec trashes an Estate',
            '.. Alec gains a Silver'
        ]);
    }

    public function testEmptyHand() {
        $this->buildGame();
        $this->setHand(['remodel']);
        $this->playCard('remodel');

        $this->assertAllCardsResolved();

        $this->assertLogContains([
           '.. Alec has nothing to trash'
        ]);
    }

    public function testTrashCurseNoCardsWorthLessThanTwoKingdom() {
        $this->buildGame();
        $this->setNumberOfCardsRemaining('estate', 0);
        $this->setNumberOfCardsRemaining('curse', 0);
        $this->setNumberOfCardsRemaining('copper', 0);
        $this->setHand(['remodel', 'copper@2', 'estate@2']);
        $this->playCard('remodel');

        $this->provideInput('copper');

        $this->assertAllCardsResolved();

        $this->assertLogContains([
            '.. Alec cannot gain anything'
        ]);
    }
}
