<?php
/** @noinspection PhpParamsInspection */

namespace Tests\Acceptance\Game\View;

use Tests\Acceptance\AcceptanceTestBase;

class WorkshopTest extends AcceptanceTestBase {

    public function testDisplaysCorrectNumberOfCardsToGain() {
        $this->buildGame();
        $this->setHand(['workshop', 'copper@4']);
        $this->playCard('workshop');

        $this->assertTestStringOccursNTimes('player-area-option', $this->buildView(), 5);
    }

}