<?php

namespace Tests\Acceptance\Game\Cards;

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

    public function testWithNoCardsInDeck() {
        $this->buildGame();
        $this->setDeck([]);
        $this->setHand(['adventurer', 'copper@4']);
        $this->playCard('adventurer');

        $this->assertHandSize(4);
        $this->assertDiscardSize(0);
        $this->assertAllCardsResolved();

        $this->assertLogContains([
            '.. Alec has nothing to draw'
        ]);
    }

    public function testWhenDeckIsOnlyVictoryCards() {
        $this->buildGame();
        $this->setDeck(['estate@3', 'duchy']);
        $this->setHand(['adventurer', 'copper@4']);
        $this->playCard('adventurer');

        $this->assertHandSize(4);
        $this->assertDiscardSize(4);

        $this->assertLogContains([
            '.. Alec reveals a Duchy and three Estates',
            '.. Alec does not put anything into their hand',
            '.. Alec puts a Duchy and three Estates into their discard'
        ]);
    }

    public function testWhenDeckContainsOneTreasureCard() {
        $this->buildGame();
        $this->setDeck(['estate@3', 'copper']);
        $this->setHand(['adventurer', 'copper@4']);
        $this->playCard('adventurer');

        $this->assertHandSize(5);
        $this->assertDiscardSize(3);

        $this->assertLogContains([
            '.. Alec reveals a Copper and three Estates',
            '.. Alec puts a Copper into their hand',
            '.. Alec puts three Estates into their discard'
        ]);
    }

    public function testWhenRevealingRequiresShuffle() {
        $this->buildGame();
        $this->setDeck(['estate@3', 'copper']);
        $this->setHand(['adventurer', 'copper@4']);
        $this->setDiscard(['village@2']);
        $this->playCard('adventurer');

        $this->assertHandSize(5);
        $this->assertDiscardSize(5);
    }
}
