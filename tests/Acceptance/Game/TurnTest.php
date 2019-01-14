<?php

namespace Tests\Acceptance\Game;

class TurnTest extends GameTestBase
{
    public function testTurnEnds()
    {
        $this->buildGame();
        $this->playTreasure('copper');
        $this->playTreasure('copper');
        $this->postUpdate('buy', 'estate');
        $this->postUpdate('end-turn');

        $this->assertTurnNumber(2);
        $this->assertOpponentDeckSize(0);
        $this->assertOpponentHandSize(5);
        $this->assertOpponentDiscardSize(6);

        $this->assertLogContains([
            '.. Alec ends their turn'
        ]);
    }

    public function testGameEnds() {
        $this->buildGame();
        $this->setNumberOfCardsRemaining('duchy', 0);
        $this->setNumberOfCardsRemaining('curse', 0);
        $this->setNumberOfCardsRemaining('estate', 1);

        $this->playCard('copper');
        $this->playCard('copper');
        $this->postUpdate('buy', 'estate');
        $this->postUpdate('end-turn');

        $this->assertGameOver();
    }
}
