<?php

namespace Tests\Acceptance\Game\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class SmithyTest extends AcceptanceTestBase
{
    public function testSmithy()
    {
        $this->buildGame();
        $this->setHand(['smithy', 'copper@4']);
        $this->playCard('smithy');
        $this->assertHandSize(7);
        $this->assertActions(0);
        $this->assertDeckSize(2);

        $this->assertLogContains([
            '.. Alec draws three cards'
        ]);
    }
}
