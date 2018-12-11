<?php

namespace Tests\Feature\Game\Cards;

class MoneylenderTest extends CardTestBase
{
    public function testMoneylender()
    {
        $this->buildGame();
        $this->setHand(['moneylender', 'copper@4']);
        $this->playCard('moneylender');
        $this->provideInput('copper');

        $this->assertHandSize(3);
        $this->assertTrashSize(1);
        $this->assertNumberOfCoins(3);
    }
}
