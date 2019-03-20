<?php
/** @noinspection PhpParamsInspection */

namespace Tests\Acceptance\Game\View;

use Tests\Acceptance\AcceptanceTestBase;

class MineTest extends AcceptanceTestBase {

    public function testDisplaysRightCardsToTrash() {
        $this->buildGame();
        $this->setHand(['mine', 'copper', 'estate@3']);
        $this->playCard('mine');

        $this->assertTestStringOccursNTimes('player-area-option', $this->buildView(),  1);
    }

    public function testMineDisplaysRightCardsToGain() {
        $this->buildGame();
        $this->setHand(['mine', 'copper@4']);
        $this->playCard('mine');
        $this->provideInput('copper');

        $view = $this->buildView();
        $this->assertStringContainsString('Silver', $view);
        $this->assertStringNotContainsString('Gold', $view);
    }

}