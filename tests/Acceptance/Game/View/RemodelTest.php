<?php
/** @noinspection PhpParamsInspection */

namespace Tests\Acceptance\Game\View;

use Tests\Acceptance\AcceptanceTestBase;

class RemodelTest extends AcceptanceTestBase {

    public function testDisplayRightNumberOfTrashOptions() {
        $this->buildGame();
        $this->setHand(['remodel', 'copper@4']);
        $this->playCard('remodel');

        $this->assertTestStringOccursNTimes('player-area-option', $this->buildView(), 4);
    }

    public function testDisplayRightGainOptions() {
        $this->buildGame();
        $this->setHand(['remodel', 'silver', 'copper@3']);
        $this->playCard('remodel');
        $this->provideInput('silver');

        $this->assertTestStringOccursNTimes('player-area-option', $this->buildView(), 6);
    }

}