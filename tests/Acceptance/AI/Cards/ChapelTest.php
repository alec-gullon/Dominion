<?php

namespace Tests\Acceptance\AI\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class ChapelTest extends AcceptanceTestBase {

    public function testPicksTheRightCardsToTrash() {
        $this->buildGameWithAI();
        $this->setOpponentDeck(['copper@5']);
        $this->setOpponentHand(['chapel', 'estate@2', 'curse', 'silver']);
        $this->update('end-turn');

        $this->assertTotalNumberOfCardsForOpponent(7);
    }

}