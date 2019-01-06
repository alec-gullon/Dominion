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
    }

    public function testNothingToDraw() {

    }

    public function testThreeCardsInHand() {

    }

    public function testDeckAndDiscardRunsOutBeforeReachingSevenCards() {

    }
}
