<?php

namespace Tests\Acceptance\AI;

class TurnTest extends AITestBase
{
    public function testAITakesTurnAfterUserTakesTurn()
    {
        $this->buildGame();
        $this->postUpdate('end-turn');

        $this->assertOpponentDiscardSize(6);
        $this->assertTurnNumber(3);
    }
}
