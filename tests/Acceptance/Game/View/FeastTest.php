<?php
/** @noinspection PhpParamsInspection */

namespace Tests\Acceptance\Game\View;

use Tests\Acceptance\AcceptanceTestBase;

class FeastTest extends AcceptanceTestBase {

    public function testDisplaysRightCardsToGain() {
        $this->buildGame();
        $this->setHand(['feast', 'copper', 'estate@3']);
        $this->playCard('feast');

        $this->assertTestStringOccursNTimes('player-area-option', $this->buildView(), 6);
    }

}