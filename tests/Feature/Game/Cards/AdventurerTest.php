<?php

namespace Tests\Feature\Game\Cards;

class AdventurerTest extends CardTestBase
{
    public function testAdventurer()
    {
        $this->buildGame();
        $this->setDeck(['copper', 'estate', 'silver', 'estate']);
        $this->setHand(['adventurer', 'copper@4']);
        $this->playCard('adventurer');
        $this->assertHandSize(6);
        $this->assertDiscardSize(1);
        $this->assertNumberOfPlayed(1);
    }
}
