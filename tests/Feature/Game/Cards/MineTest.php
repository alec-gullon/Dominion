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
    }

    public function testTrashCopperWithNoCopperAndSilverInKingdom() {

    }
}
