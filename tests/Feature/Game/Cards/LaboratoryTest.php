<?php

namespace Tests\Feature\Game\Cards;

class LaboratoryTest extends CardTestBase
{
    public function testFestival()
    {
        $this->buildGame();
        $this->setHand(['laboratory', 'copper@4']);
        $this->playCard('laboratory');
        $this->assertHandSize(6);
        $this->assertActions(1);
    }
}
