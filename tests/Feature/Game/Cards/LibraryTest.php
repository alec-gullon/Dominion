<?php

namespace Tests\Feature\Game\Cards;

class LibraryTest extends CardTestBase
{
    public function testLibrary()
    {
        $this->buildGame();
        $this->setDeck(['copper', 'village@2', 'estate@2']);
        $this->setHand(['library', 'copper@4']);
        $this->playCard('library');

        $this->assertHandSize(5);

        $this->provideInput(true);

        $this->assertHandSize(5);
        $this->assertNumberOfSetAside(1);

        $this->provideInput(false);

        $this->assertHandSize(7);
        $this->assertNumberOfSetAside(0);
        $this->assertDiscardSize(1);

        $this->assertLogContains([
            '.. Alec draws a card',
            '.. Alec sets aside a Village',
            '.. Alec draws two cards',
            '.. Alec discards a Village that they set aside'
        ]);
        $this->assertLogCountEquals(5);
    }

    public function testNothingToDraw() {
        $this->buildGame();
        $this->setDeck([]);
        $this->setDiscard([]);
        $this->setHand(['library', 'copper@4']);
        $this->playCard('library');

        $this->assertHandSize(4);
        $this->assertAllCardsResolved();

        $this->assertLogContains([
            '.. Alec has nothing left to draw'
        ]);
        $this->assertLogCountEquals(2);
    }

    public function testThreeCardsInHand() {
        $this->buildGame();
        $this->setDeck(['copper', 'village@2', 'estate@3']);
        $this->setHand(['library', 'copper@2']);
        $this->playCard('library');

        $this->provideInput(false); // don't discard village
        $this->provideInput(false); // don't discard second village

        $this->assertHandSize(7);
        $this->assertDeckSize(1);
        $this->assertDiscardSize(0);
        $this->assertAllCardsResolved();

        $this->assertLogContains([
            '.. Alec draws five cards',
        ]);
        $this->assertLogCountEquals(2);
    }

    public function testDeckAndDiscardRunsOutBeforeReachingSevenCards() {
        $this->buildGame();
        $this->setDeck(['copper', 'village@2']);
        $this->setHand(['library', 'copper@2']);
        $this->playCard('library');

        $this->provideInput(false); // don't discard village
        $this->provideInput(false); // don't discard second village

        $this->assertHandSize(5);
        $this->assertDeckSize(0);
        $this->assertAllCardsResolved();

        $this->assertLogContains([
            '.. Alec draws three cards',
            '.. Alec has nothing left to draw'
        ]);
        $this->assertLogCountEquals(3);

    }
}
