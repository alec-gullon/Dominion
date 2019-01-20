<?php

namespace Tests\Acceptance\AI\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class MilitiaTest extends AcceptanceTestBase {

    public function testDiscardsVictoryCardsIfPossible() {
        $this->buildGameWithAI();
        $this->setHand(['militia', 'estate@2', 'copper@2']);
        $this->setOpponentHand(['estate@2', 'copper@3']);
        $this->playCard('militia');

        $this->assertAllCardsResolved();
        $this->assertOpponentDiscardSize(2);
    }

    public function testPrioritisesCardsAppropriately() {
        $this->buildGameWithAI();
        $this->setHand(['militia', 'estate@2', 'copper@2']);
        $this->setOpponentHand(['witch', 'gold@3', 'smithy', 'province']);
        $this->playCard('militia');

        $this->assertAllCardsResolved();
        $this->assertOpponentDiscardContains('province');
        $this->assertOpponentDiscardContains('smithy');
    }

}