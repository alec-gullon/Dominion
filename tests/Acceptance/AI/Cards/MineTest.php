<?php

namespace Tests\Acceptance\AI\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class MineTest extends AcceptanceTestBase {

    public function testSelectsSilverIfTrashingCopper() {
        $this->buildGameWithAI();
        $this->setOpponentHand(['mine', 'copper@4']);
        $this->update('end-turn');

        $this->assertOpponentsNumberOfRemainingCards('silver', 2);
    }

    public function testSelectsGoldIfTrashingSilver() {
        $this->buildGameWithAI();
        $this->setOpponentHand(['mine', 'silver@4']);
        $this->update('end-turn');

        $this->assertOpponentsNumberOfRemainingCards('gold', 1);
    }

}