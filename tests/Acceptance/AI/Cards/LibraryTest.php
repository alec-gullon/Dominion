<?php

namespace Tests\Acceptance\AI\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class LibraryTest extends AcceptanceTestBase {

    public function testPutsAsideActionCardsIfActionsHaveRunOut() {
        $this->buildGameWithAI();
        $this->setOpponentDeck(['village@2', 'copper@3']);
        $this->setOpponentHand(['library', 'estate@4']);
        $this->update('end-turn');

        $this->assertNumberOfRemainingCards('silver', 19);
    }

}