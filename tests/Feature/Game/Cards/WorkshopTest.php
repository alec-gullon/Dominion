<?php

namespace Tests\Feature\Game\Cards;

class WorkshopTest extends CardTestBase
{
    public function testWorkshop()
    {
        $this->buildGame();
        $this->setHand(['workshop', 'copper@4']);
        $this->playCard('workshop');

        $this->assertHandSize(4);
        $this->assertNumberOfPlayed(1);
        $this->assertActions(0);

        $this->provideInput('silver');

        $this->assertDiscardSize(1);
        $this->assertNumberOfRemainingCards('silver', 19);
    }
}
