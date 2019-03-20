<?php
/** @noinspection PhpParamsInspection */

namespace Tests\Acceptance\Game\View;

use Tests\Acceptance\AcceptanceTestBase;

class SpyTest extends AcceptanceTestBase {

    public function testDisplaysCorrectMessagesToBothPlayers() {
        $this->buildGame();
        $this->setHand(['spy', 'copper@4']);
        $this->playCard('spy');

        $this->assertStringContainsString(
            'You reveal an Estate from the top of your deck. Do you want to discard it?',
            $this->buildView()
        );
        $this->assertStringContainsString(
            'Alec reveals an Estate from the top of their deck. They are deciding whether to discard it or not...',
            $this->buildView(true)
        );

        $this->provideInput(true);

        $this->assertStringContainsString(
            'You reveal an Estate from the top of their deck. Do you want to discard it?',
            $this->buildView()
        );
        $this->assertStringContainsString(
            'Alec reveals an Estate from the top of your deck. They are deciding whether to discard it or not...',
            $this->buildView(true)
        );
    }

}