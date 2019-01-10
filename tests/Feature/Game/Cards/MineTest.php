<?php

namespace Tests\Feature\Game\Cards;

class MineTest extends CardTestBase
{
    public function testMine()
    {
        $this->buildGame();
        $this->setHand(['mine', 'copper@4']);
        $this->playCard('mine');
        $this->provideInput('copper');

        $this->assertHandSize(3);
        $this->assertTrashSize(1);

        $this->provideInput('silver');

        $this->assertHandSize(4);
        $this->assertNumberOfRemainingCards('silver', 19);

        $this->assertLogContains([
            '.. Alec trashes a Copper',
            '.. Alec gains a Silver, putting it in their hand'
        ]);
    }

    public function testTrashCopperWithNoCopperAndSilverInKingdom() {
        $this->buildGame();
        $this->setHand(['mine', 'copper@4']);
        $this->setNumberOfCardsRemaining('copper', 0);
        $this->setNumberOfCardsRemaining('silver', 0);
        $this->playCard('mine');
        $this->provideInput('copper');

        $this->assertAllCardsResolved();

        $this->assertLogContains([
            '.. Alec trashes a Copper',
            '.. Alec has no cards which they can gain'
        ]);
    }

    public function testNoTreasureCardInHand() {
        $this->buildGame();
        $this->setHand(['mine', 'village@4']);
        $this->playCard('mine');

        $this->assertAllCardsResolved();

        $this->assertLogContains([
            '.. Alec has nothing to trash'
        ]);
    }
}
