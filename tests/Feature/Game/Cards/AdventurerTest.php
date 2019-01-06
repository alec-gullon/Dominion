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

        $this->assertLogContains([
            'Alec plays an Adventurer',
            '.. Alec reveals a Copper, an Estate and a Silver',
            '.. Alec puts a Copper and a Silver into their hand',
            '.. Alec puts an Estate into their discard'
        ]);
    }

    public function testAdventurerWithNoCardsInDeck() {

    }

    public function testAdventurerWhenDeckIsOnlyVictoryCards() {

    }

    public function testAdventurerWhenDeckContainsOneTreasureCard() {

    }

    public function testAdventurerWhenRevealingRequiresShuffle() {

    }
}
