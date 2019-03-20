<?php
/** @noinspection PhpParamsInspection */

namespace Tests\Acceptance\Game\View;

use Tests\Acceptance\AcceptanceTestBase;

class ChancellorTest extends AcceptanceTestBase {

    public function testDisplaysRightQuestion() {
        $this->buildGame();
        $this->setHand(['chancellor', 'copper@4']);
        $this->playCard('chancellor');

        $this->assertStringContainsString('Put Deck in Discard?', $this->buildView());
    }

}