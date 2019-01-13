<?php

namespace Tests\Acceptance\Game\Cards;

class SmithyTest extends CardTestBase
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
