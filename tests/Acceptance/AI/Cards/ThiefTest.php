<?php

namespace Tests\Acceptance\AI\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class ThiefTest extends AcceptanceTestBase {

    public function testSelectsTheBetterCardToTrashAndGainsIt() {
        $this->buildGameWithAI();
        $this->setOpponentHand(['thief', 'copper@4']);
        $this->setDeck(['copper@5', 'gold', 'copper']);
        $this->postUpdate('end-turn');

        $this->assertOpponentsNumberOfRemainingCards('gold', 1);
        $this->assertAllCardsResolved();
    }

    public function testDoesNotSelectAnythingIfTwoCoppersRevealed() {
        $this->buildGameWithAI();
        $this->setOpponentHand(['thief', 'silver@4']);
        $this->setOpponentDeck([]);
        $this->setDeck(['copper@10']);
        $this->postUpdate('end-turn');

        $this->assertOpponentsNumberOfRemainingCards('copper', 0);
        $this->assertAllCardsResolved();
    }

}