<?php
/** @noinspection PhpParamsInspection */

namespace Tests\Acceptance\Game\View;

use Tests\Acceptance\AcceptanceTestBase;

class ChapelTest extends AcceptanceTestBase {

    public function testDisplaysRightAmountOfCardsToTrash() {
        $this->buildGame();
        $this->setHand(['chapel', 'copper@4']);
        $this->playCard('chapel');

        $this->assertTestStringOccursNTimes('player-area-checkbox', $this->buildView(), 4);
    }

}