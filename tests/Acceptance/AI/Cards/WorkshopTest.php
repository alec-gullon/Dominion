<?php

namespace Tests\Acceptance\AI\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class WorkshopTest extends AcceptanceTestBase {

    public function testWorkshopGainsAFourCostCard() {
        $this->buildGameWithAI();
        $kingdom = [
            'copper' => 30,
            'silver' => 20,
            'gold' => 10,
            'estate' => 8,
            'duchy' => 8,
            'province' => 8,
            'village' => 10,
            'smithy' => 10,
            'curse' => 10
        ];
        $this->setKingdom($kingdom);

        $this->setOpponentHand(['workshop', 'copper@4']);
        $this->postUpdate('end-turn');

        $this->assertNumberOfRemainingCards('smithy', 9);
    }

}