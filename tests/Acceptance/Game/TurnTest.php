<?php

namespace Tests\Acceptance\Game;

use Tests\Acceptance\AcceptanceTestBase;

class TurnTest extends AcceptanceTestBase
{
    public function testTurnEnds()
    {
        $this->buildGame();
        $this->playTreasure('copper');
        $this->playTreasure('copper');
        $this->update('buy', 'estate');
        $this->update('end-turn');

        $this->assertTurnNumber(2);
        $this->assertOpponentDeckSize(0);
        $this->assertOpponentHandSize(5);
        $this->assertOpponentDiscardSize(6);

        $this->assertLogContains([
            'Alec ends their turn'
        ]);
    }

    public function testGameEnds() {
        $this->buildGame();
        $this->setNumberOfCardsRemaining('duchy', 0);
        $this->setNumberOfCardsRemaining('curse', 0);
        $this->setNumberOfCardsRemaining('estate', 1);

        $this->playTreasure('copper');
        $this->playTreasure('copper');
        $this->update('buy', 'estate');
        $this->update('end-turn');

        $this->assertGameOver();
    }
}
