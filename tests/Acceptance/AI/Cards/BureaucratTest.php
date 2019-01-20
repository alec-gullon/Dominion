<?php

namespace Tests\Acceptance\AI\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class BureaucratTest extends AcceptanceTestBase {

    public function testRevealsMoatIfPossible() {
        $this->buildGameWithAI();
        $kingdom = [
            'copper' => 30,
            'silver' => 20,
            'gold' => 10,
            'estate' => 8,
            'duchy' => 8,
            'province' => 8,
            'curse' => 10,
            'moat' => 10
        ];
        $this->setKingdom($kingdom);
        $this->setHand(['bureaucrat', 'estate@2', 'copper@2']);
        $this->setOpponentHand(['moat', 'estate@2', 'copper@2']);
        $this->playCard('bureaucrat');

        $this->assertAllCardsResolved();
        $this->assertOpponentDeckSize(5);
    }

    public function testPicksAVictoryCardWhenPromptedTo() {
        $this->buildGameWithAI();
        $this->setHand(['bureaucrat', 'estate@2', 'copper@2']);
        $this->playCard('bureaucrat');

        $this->assertAllCardsResolved();
        $this->assertOpponentDeckSize(6);
    }

}