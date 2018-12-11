<?php

namespace Tests\Feature\Game\Cards;

class CouncilRoomTest extends CardTestBase
{
    public function testCouncilRoom() {
        $this->buildGame();
        $this->setHand(['council-room', 'copper@4']);
        $this->playCard('council-room');

        $this->assertHandSize(8);
        $this->assertNumberOfPlayed(1);
        $this->assertOpponentHandSize(6);
    }
}
