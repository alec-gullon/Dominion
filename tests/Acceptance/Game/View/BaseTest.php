<?php
/** @noinspection PhpParamsInspection */

namespace Tests\Acceptance\Game\View;

use Tests\Acceptance\AcceptanceTestBase;

class BaseTest extends AcceptanceTestBase {

    public function testBasicGameboard() {
        $this->buildGame();
        $view = $this->buildView();

        $this->assertStringContainsString('Select a card to play', $view);
        $this->assertTestStringOccursNTimes('kingdom-card', $view, 1);
        $this->assertTestStringOccursNTimes('common-card', $view, 7);
        $this->assertTestStringOccursNTimes('hand-card', $view, 5);
        $this->assertTestStringOccursNTimes('log-entry', $view, 0);
    }

    public function testOnlyDisplaysCardsThatCanBePlayed() {
        $this->buildGame();

        $this->assertTestStringOccursNTimes('player-area-option', $this->buildView(), 6);
    }

    public function testDoesNotDisplayPlayAllTreasuresWhenNoTreasureInHand() {
        $this->buildGame();
        $this->setHand(['estate@5', 'village']);

        $this->assertTestStringOccursNTimes('player-area-option', $this->buildView(), 2);
    }

}