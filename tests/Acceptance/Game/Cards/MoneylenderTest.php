<?php

namespace Tests\Acceptance\Game\Cards;

use Tests\Acceptance\AcceptanceTestBase;

class MoneylenderTest extends AcceptanceTestBase
{
    public function testMoneylender()
    {
        $this->buildGame();
        $this->setHand(['moneylender', 'copper@4']);
        $this->playCard('moneylender');
        $this->provideInput(true);

        $this->assertHandSize(3);
        $this->assertTrashSize(1);
        $this->assertNumberOfCoins(3);

        $this->assertLogContains([
            '.. Alec trashes a Copper',
            '.. Alec gains three coins'
        ]);
    }

    public function testDoesNotTrash() {
        $this->buildGame();
        $this->setHand(['moneylender', 'copper@4']);
        $this->playCard('moneylender');
        $this->provideInput(false);

        $this->assertHandSize(4);
        $this->assertTrashSize(0);

        $this->assertLogContains([
            '.. Alec does not trash anything'
        ]);
    }
}
