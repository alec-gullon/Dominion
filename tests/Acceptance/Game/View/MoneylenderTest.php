<?php
/** @noinspection PhpParamsInspection */

namespace Tests\Acceptance\Game\View;

use Tests\Acceptance\AcceptanceTestBase;

class MoneylenderTest extends AcceptanceTestBase {

    public function testDisplaysBothOptions() {
        $this->buildGame();
        $this->setHand(['moneylender', 'copper@4']);
        $this->playCard('moneylender');

        $this->assertStringContainsString('data-option="true"', $this->buildView());
    }

    public function testDoesNotDisplayTrashOptionIfOutOfCopper() {
        $this->buildGame();
        $this->setHand(['moneylender', 'estate@4']);
        $this->playCard('moneylender');

        $this->assertStringNotContainsString('data-option="true"', $this->buildView());
    }

}