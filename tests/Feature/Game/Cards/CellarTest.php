<?php

namespace Tests\Feature\Game\Cards;

class CellarTest extends CardTestBase
{
    public function testCellar()
    {
        $this->buildGame();
        $this->setHand(['cellar', 'copper@2', 'estate@2']);
        $this->playCard('cellar');

        $this->assertHandSize(4);
        $this->assertNumberOfPlayed(1);
        $this->assertActions(1);

        $this->provideInput(array('estate', 'estate'));

        $this->assertHandSize(4);
        $this->assertDeckSize(3);

        $this->assertLogContains([
            '.. Alec discards two Estates',
            '.. Alec draws two cards'
        ]);
    }

    public function testWhenCellarIsLastCardInHand() {
        $this->buildGame();
        $this->setHand(['cellar']);
        $this->playCard('cellar');

        $this->assertAllCardsResolved();

        $this->assertLogContains([
            '.. Alec has nothing to discard'
        ]);
    }

    public function testEmptyDeckWithCardsInDiscard() {
        $this->buildGame();
        $this->setHand(['cellar', 'copper@2', 'estate@2']);
        $this->setDeck([]);
        $this->setDiscard(['copper']);
        $this->playCard('cellar');

        $this->provideInput(array('estate', 'estate'));

        $this->assertHandSize(4);
        $this->assertDeckSize(1);

        $this->assertLogContains([
            '.. Alec discards two Estates',
            '.. Alec draws two cards'
        ]);
    }

    public function testEmptyDeckAndDiscard() {
        $this->buildGame();
        $this->setHand(['cellar', 'copper@2', 'estate@2']);
        $this->setDeck([]);
        $this->playCard('cellar');

        $this->provideInput(array('estate', 'estate'));

        $this->assertHandSize(4);
        $this->assertDeckSize(0);

        $this->assertLogContains([
            '.. Alec discards two Estates',
            '.. Alec draws two cards'
        ]);
    }
}
