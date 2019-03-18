<?php

namespace Tests\Acceptance\AI\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class CellarTest extends AcceptanceTestBase {

    public function testDiscardsAppropriateCards() {
        $this->buildGameWithAI();
        $this->setOpponentDeck(['copper@5']);
        $this->setOpponentHand(['cellar', 'estate@2', 'copper@2']);
        $this->update('end-turn');

        $this->assertNumberOfRemainingCards('silver', 19);
        $this->assertTotalNumberOfCardsForOpponent(11);
    }

    public function testDiscardsCursesIfTheyExistInHand() {
        $this->buildGameWithAI();
        $this->setOpponentDeck(['copper@6']);
        $this->setOpponentHand(['cellar', 'estate', 'curse', 'copper']);
        $this->update('end-turn');

        $this->assertNumberOfRemainingCards('silver', 19);
        $this->assertTotalNumberOfCardsForOpponent(11);
    }


}