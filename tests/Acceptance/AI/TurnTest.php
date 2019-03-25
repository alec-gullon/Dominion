<?php

namespace Tests\Acceptance\AI;

use Tests\Acceptance\AcceptanceTestBase;

class TurnTest extends AcceptanceTestBase
{
    public function testAITakesTurnAfterUserTakesTurn() {
        $this->buildGameWithAI();
        $this->update('end-turn');

        $this->assertTurnNumber(3);
    }

    public function testAIBuysACardOnFirstTurn() {
        $this->buildGameWithAI();
        $this->update('end-turn');

        $this->assertOpponentDiscardSize(6);
    }

    public function testAIPlaysVillageBeforeSmithy() {
        $this->buildGameWithAI();
        $this->setOpponentHand(['village', 'smithy', 'copper@3']);
        $this->update('end-turn');

        $this->assertTurnNumber(3);
        $this->assertOpponentDeckSize(6);
        $this->assertNumberOfRemainingCards('silver', 19);
    }

    public function testAIPlaysWitchInsteadOfSmithy() {
        $this->buildGameWithAI();
        $this->setOpponentHand(['smithy', 'witch', 'copper@3']);
        $this->update('end-turn');

        $this->assertOpponentDeckSize(6);
        $this->assertNumberOfRemainingCards('curse', 9);
    }

    public function testAIAdvancesToBuyStageIfItHasNoTreasuresToPlay() {
        $this->buildGameWithAI();
        $this->setOpponentHand(['woodcutter@2', 'market@2']);
        $this->update('end-turn');

        $this->assertNumberOfRemainingCards('silver', 19);
    }
}
