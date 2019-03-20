<?php
/** @noinspection PhpParamsInspection */

namespace Tests\Acceptance\Game\View;

use Tests\Acceptance\AcceptanceTestBase;

class CellarTest extends AcceptanceTestBase {

    public function testDisplaysRightAmountOfCardsToDiscard() {
        $this->buildGame();
        $this->setHand(['cellar', 'copper@4']);
        $this->playCard('cellar');

        $this->assertTestStringOccursNTimes('player-area-checkbox', $this->buildView(), 4);
    }

}