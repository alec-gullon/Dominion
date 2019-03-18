<?php

namespace Tests\Acceptance\Game\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class LaboratoryTest extends AcceptanceTestBase
{
    public function testLaboratory()
    {
        $this->buildGame();
        $this->setHand(['laboratory', 'copper@4']);
        $this->playCard('laboratory');
        $this->assertHandSize(6);
        $this->assertActions(1);

        $this->assertLogContains([
            '.. Alec draws two cards',
            '.. Alec gains an action'
        ]);
    }
}
