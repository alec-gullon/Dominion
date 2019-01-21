<?php

namespace Tests\Acceptance\AI\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class SpyTest extends AcceptanceTestBase {

    public function testDiscardsAUsefulCardIfOpponentRevealsOne() {
        $this->buildGameWithAI();
        $this->setOpponentHand(['spy', 'copper@4']);
        $this->setDeck(['copper@5', 'gold', 'estate@15']);
        $this->setOpponentDeck(['copper', 'gold', 'estate@15']);
        $this->postUpdate('end-turn');

        $this->assertTurnNumber(3);
        $this->assertDiscardSize(6);
        $this->assertOpponentDiscardSize(7); // +1 from playing Spy, +1 from buy
    }

    public function testForcesOpponentToKeepCrud() {
        $this->buildGameWithAI();
        $this->setOpponentHand(['spy', 'copper@4']);
        $this->setDeck(['copper@5', 'province', 'estate@15']);
        $this->setOpponentDeck(['copper', 'duchy', 'estate@15']);
        $this->postUpdate('end-turn');

        $this->assertTurnNumber(3);
        $this->assertDiscardSize(5);
        $this->assertOpponentDiscardSize(8); // +1 from playing Spy, +1 from buy, +1 from discard
    }

}