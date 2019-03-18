<?php

namespace Tests\Acceptance\Game\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class MoatTest extends AcceptanceTestBase
{
    public function testMoat() {
        $this->buildGameWithMoat();
        $this->setHand(['moat', 'copper@4']);
        $this->playCard('moat');

        $this->assertHandSize(6);
        $this->assertNumberOfPlayed(1);
        $this->assertActions(0);

        $this->assertLogContains([
            '.. Alec draws two cards'
        ]);
    }
}
