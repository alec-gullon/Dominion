<?php

namespace Tests\Acceptance\Game\Cards;

class ThiefTest extends CardTestBase
{
    public function testThief() {
        $this->buildGame();
        $this->setHand(['thief', 'copper@4']);
        $this->setOpponentDeck(['silver', 'copper@4']);
        $this->playCard('thief');

        $this->assertOpponentDeckSize(3);
        $this->assertOpponentRevealedSize(2);

        $this->provideInput('silver');

        $this->provideInput(true);

        $this->assertTrashSize(0);
        $this->assertDiscardSize(1);
        $this->assertOpponentDiscardSize(1);

        $this->assertLogContains([
            '.. Lucy reveals a Silver from the top of their deck',
            '.. Lucy reveals a Copper from the top of their deck',
            '.. Lucy puts the Silver in Alec\'s discard',
            '.. Lucy discards a Copper from their revealed'
        ]);

    }

    public function testWithMoat() {
        $this->buildGameWithMoat();
        $this->setHand(['thief', 'copper@4']);
        $this->setOpponentHand(['moat']);
        $this->playCard('thief');
        $this->provideInput(true);

        $this->assertAllCardsResolved();

        $this->assertLogCountEquals(2);
    }

    public function testWhenOnlyRevealOneTreasureCard() {
        $this->buildGame();
        $this->setHand(['thief', 'copper@4']);
        $this->setopponentDeck(['copper', 'estate']);
        $this->playCard('thief');

        $this->provideInput(false);

        $this->assertTrashSize(1);
        $this->assertOpponentDiscardSize(1);
        $this->assertDiscardSize(0);

        $this->assertLogContains([
            '.. Lucy reveals a Copper from the top of their deck',
            '.. Lucy reveals an Estate from the top of their deck',
            '.. Lucy trashes the Copper from their revealed',
            '.. Lucy discards an Estate from their revealed'
        ]);
    }

    public function testWhenRevealNoTreasure() {
        $this->buildGame();
        $this->setHand(['thief', 'copper@4']);
        $this->setopponentDeck(['estate@2']);
        $this->playCard('thief');

        $this->assertOpponentDiscardSize(2);
        $this->assertOpponentDeckSize(0);
        $this->assertAllCardsResolved();

        $this->assertLogContains([
            '.. Lucy puts two Estates into their discard'
        ]);
    }

    public function testCannotTrashSomethingTheyShouldNot() {
        $this->buildGame();
        $this->setHand(['thief', 'copper@4']);
        $this->setOpponentDeck(['silver', 'copper@4']);
        $this->playCard('thief');

        $this->provideInput('estate');

        $this->assertNextStep('resolve-attack');
    }
}