<?php

namespace Tests\Acceptance\AI\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class FeastTest extends AcceptanceTestBase {

    public function testGainsWitchIfAvailable() {
        $this->buildGameWithAI();
        $kingdom = [
            'copper' => 30,
            'silver' => 20,
            'gold' => 10,
            'estate' => 8,
            'duchy' => 8,
            'province' => 8,
            'curse' => 10,
            'witch' => 10
        ];
        $this->setKingdomCards($kingdom);
        $this->setOpponentHand(['feast', 'copper@4']);
        $this->postUpdate('end-turn');

        $this->assertTotalNumberOfCardsForOpponent(11);
        $this->assertNumberOfRemainingCards('witch', 9);
    }

}