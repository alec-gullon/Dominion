<?php

namespace Tests\Acceptance\Game\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class CouncilRoomTest extends AcceptanceTestBase
{
    public function testCouncilRoom() {
        $this->buildGame();
        $this->setHand(['council-room', 'copper@4']);
        $this->playCard('council-room');

        $this->assertHandSize(8);
        $this->assertNumberOfPlayed(1);
        $this->assertOpponentHandSize(6);

        $this->assertLogContains([
            '.. Alec draws four cards',
            '.. Alec gains a buy',
            '.. Lucy draws a card'
        ]);
    }

    public function testOpponentCanDrawNothing() {
        $this->buildGame();
        $this->setHand(['council-room', 'copper@4']);
        $this->setOpponentDeck([]);
        $this->playCard('council-room');

        $this->assertOpponentHandSize(5);
        $this->assertHandSize(8);

        $this->assertLogContains([
            '.. Lucy draws nothing'
        ]);
    }
}
