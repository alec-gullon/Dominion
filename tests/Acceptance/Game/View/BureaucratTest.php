<?php
/** @noinspection PhpParamsInspection */

namespace Tests\Acceptance\Game\View;

use Tests\Acceptance\AcceptanceTestBase;

class BureaucratTest extends AcceptanceTestBase {

    public function testDisplaysRightCardsToTrash() {
        $this->buildGame();
        $this->setHand(['bureaucrat', 'copper@4']);
        $this->playCard('bureaucrat');

        $this->assertStringContainsString('Lucy is selecting a card', $this->buildView());

        $view = $this->buildView(true);
        $this->assertTestStringOccursNTimes('player-area-option', $view, 1);
    }

}