<?php
/** @noinspection PhpParamsInspection */

namespace Tests\Acceptance\Game\View;

use Tests\Acceptance\AcceptanceTestBase;

class MilitiaTest extends AcceptanceTestBase {

    public function testDisplaysRightCardsToTrash() {
        $this->buildGame();
        $this->setHand(['militia', 'copper', 'estate@3']);
        $this->playCard('militia');

        $this->assertStringContainsString('Lucy is selecting cards to discard', $this->buildView());

        $this->assertTestStringOccursNTimes('player-area-checkbox', $this->buildView(true), 5);
    }

}