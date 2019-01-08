<?php

namespace Tests\Feature\Game\Cards;

class SpyTest extends CardTestBase
{
    public function testSpy() {
        $this->buildGame();
        $this->setDeck(['copper@4', 'estate@1']);
        $this->setHand(['spy', 'copper@4']);
        $this->setOpponentDeck(['copper@5']);
        $this->setOpponentHand(['copper@2', 'estate@3']);
        $this->playCard('spy');

        $this->assertHandSize(5);
        $this->assertActions(1);

        $this->provideInput(true);

        $this->assertDeckSize(3);

        $this->provideInput(false);

        $this->assertOpponentDeckSize(5);

        $this->assertAllCardsResolved();

        $this->assertLogContains([
            '.. Alec gains an action',
            '.. Alec draws a card',
            '.. Alec reveals a Copper',
            '.. Alec discards a Copper',
            '.. Lucy reveals a Copper',
            '.. Lucy places the Copper on top of their deck'
        ]);
    }

    public function testActiveKeepsOffendingDiscards() {
        $this->buildGame();
        $this->setDeck(['copper@4', 'estate@1']);
        $this->setHand(['spy', 'copper@4']);
        $this->setOpponentDeck(['copper@5']);
        $this->setOpponentHand(['copper@2', 'estate@3']);
        $this->playCard('spy');

        $this->provideInput(false);
        $this->provideInput(true);

        $this->assertHandSize(5);
        $this->assertActions(1);
        $this->assertDeckSize(4);
        $this->assertOpponentDeckSize(4);
        $this->assertAllCardsResolved();

        $this->assertLogContains([
            '.. Alec gains an action',
            '.. Alec draws a card',
            '.. Alec reveals a Copper',
            '.. Alec places the Copper on top of their deck',
            '.. Lucy reveals a Copper',
            '.. Lucy discards a Copper'
        ]);
    }

    public function testActivePlayerCannotDrawAnything() {
        $this->buildGame();
        $this->setDeck(['copper']);
        $this->setHand(['spy', 'copper@4']);
        $this->setOpponentDeck(['copper']);
        $this->setOpponentHand(['copper@2', 'estate@3']);
        $this->playCard('spy');

        $this->provideInput(true);

        $this->assertAllCardsResolved();

        $this->assertLogContains([
            '.. Alec has no cards to reveal'
        ]);
        $this->assertLogCountEquals(6);
    }

    public function testSecondaryPlayerCannotDrawAnything() {
        $this->buildGame();
        $this->setDeck(['copper@4']);
        $this->setHand(['spy', 'copper@4']);
        $this->setOpponentDeck([]);
        $this->setOpponentHand(['copper@2', 'estate@3']);
        $this->playCard('spy');

        $this->provideInput(true);

        $this->assertAllCardsResolved();

        $this->assertLogContains([
            '.. Lucy has no cards to reveal'
        ]);
        $this->assertLogCountEquals(6);
    }


}
