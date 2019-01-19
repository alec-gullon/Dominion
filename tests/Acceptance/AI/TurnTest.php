<?php

namespace Tests\Acceptance\AI;

use Tests\Acceptance\AcceptanceTestBase;

class TurnTest extends AcceptanceTestBase
{
    public function testAITakesTurnAfterUserTakesTurn() {
        $this->buildGameWithAI();
        $this->postUpdate('end-turn');

        $this->assertTurnNumber(3);
    }

    public function testAIBuysACardOnFirstTurn() {
        $this->buildGameWithAI();
        $this->postUpdate('end-turn');

        $this->assertOpponentDiscardSize(6);
    }

    public function testAIPlaysVillageBeforeSmithy() {
        $this->buildGameWithAI();
        $this->setOpponentHand(['village', 'smithy', 'copper@3']);
        $this->postUpdate('end-turn');

        $this->assertTurnNumber(3);
        $this->assertOpponentDeckSize(6);
        $this->assertNumberOfRemainingCards('silver', 19);
    }

    public function testAIPlaysWitchInsteadOfSmithy() {
        $this->buildGameWithAI();
        $this->setOpponentHand(['smithy', 'witch', 'copper@3']);
        $this->postUpdate('end-turn');

        $this->assertOpponentDeckSize(6);
        $this->assertNumberOfRemainingCards('curse', 9);
    }
}
