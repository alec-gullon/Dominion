<?php

namespace Tests\Acceptance\AI\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class RemodelTest extends AcceptanceTestBase {

    public function testTrashesEstateIfPossible() {
        $this->buildGameWithAI();
        $this->setOpponentHand(['remodel', 'estate', 'copper@3']);
        $this->postUpdate('end-turn');

        $this->assertTurnNumber(3);
        $this->assertTrashSize(1);

        $this->assertTotalNumberOfCardsForOpponent(11); // -1 due to trash, +1 due to gaining from remodel, +1 due to buy
        $this->assertOpponentsNumberOfRemainingCards('estate', 2);
    }

    public function testGainsAttackIfPossible() {
        $this->buildGameWithAI();
        $kingdom = [
            'copper' => 30,
            'silver' => 20,
            'gold' => 10,
            'estate' => 8,
            'duchy' => 8,
            'province' => 8,
            'village' => 10,
            'militia' => 10,
            'curse' => 10
        ];
        $this->setKingdomCards($kingdom);
        $this->setOpponentHand(['remodel', 'estate', 'copper@3']);
        $this->postUpdate('end-turn');

        $this->assertTurnNumber(3);
        $this->assertTrashSize(1);

        $this->assertOpponentsNumberOfRemainingCards('estate', 2);
        $this->assertNumberOfRemainingCards('militia', 9);
    }

}