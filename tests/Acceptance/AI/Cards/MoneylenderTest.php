<?php

namespace Tests\Acceptance\AI\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class MoneylenderTest extends AcceptanceTestBase {

    public function testTrashesCopperIfPossible() {
        $this->buildGameWithAI();
        $this->setOpponentHand(['moneylender', 'copper@2']);
        $this->update('end-turn');

        $this->assertOpponentsNumberOfRemainingCards('village', 1);
    }

    public function testResolvesIfDoesNotHaveCopper() {
        $this->buildGameWithAI();
        $this->setOpponentHand(['moneylender', 'silver@2']);
        $this->update('end-turn');

        $this->assertOpponentsNumberOfRemainingCards('village', 1);
    }

}