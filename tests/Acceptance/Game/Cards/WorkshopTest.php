<?php

namespace Tests\Acceptance\Game\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class WorkshopTest extends AcceptanceTestBase
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

        $this->assertLogContains([
            '.. Alec gains a Silver'
        ]);
    }

    public function testCannotAcquireExpensiveCard() {
        $this->buildGame();
        $this->setHand(['workshop', 'copper@4']);
        $this->playCard('workshop');
        $this->provideInput('province');

        $this->assertNextStep('gain-selected-card');
    }
}
