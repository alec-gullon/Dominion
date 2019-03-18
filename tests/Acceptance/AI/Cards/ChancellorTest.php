<?php

namespace Tests\Acceptance\AI\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class ChancellorTest extends AcceptanceTestBase {

    public function testAlwaysPutsDeckInDiscard() {
        $this->buildGameWithAI();
        $this->setOpponentDeck(['copper@5']);
        $this->setOpponentHand(['chancellor', 'estate@2', 'copper@2']);
        $this->update('end-turn');

        $this->assertOpponentDiscardSize(0);
    }

}