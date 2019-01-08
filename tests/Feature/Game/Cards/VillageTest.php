<?php

namespace Tests\Feature\Game\Cards;

class VillageTest extends CardTestBase
{
    public function testVillage()
    {
        $this->buildGame();
        $this->setHand(['village', 'copper@2', 'estate@2']);
        $this->playCard('village');
        $this->assertHandSize(5);
        $this->assertActions(2);
        $this->assertDeckSize(4);
        $this->assertNumberOfPlayed(1);

        $this->assertLogContains([
            'Alec plays a Village',
            '.. Alec draws a card',
            '.. Alec gains two actions'
        ]);
    }

    public function testVillageWithNoCardsInDeck() {
        $this->buildGame();
        $this->setHand(['village', 'copper@4']);
        $this->setDeck([]);
        $this->playCard('village');
        $this->assertHandSize(4);
        $this->assertActions(2);
        $this->assertDeckSize(0);
        $this->assertNumberOfPlayed(1);

        $this->assertLogContains([
            '.. Alec draws nothing',
            '.. Alec gains two actions'
        ]);
    }
}
