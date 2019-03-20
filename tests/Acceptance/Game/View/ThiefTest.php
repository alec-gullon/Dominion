<?php
/** @noinspection PhpParamsInspection */

namespace Tests\Acceptance\Game\View;

use Tests\Acceptance\AcceptanceTestBase;

class ThiefTest extends AcceptanceTestBase {

    public function testDisplaysCorrectMessagesToBothPlayers() {
        $this->buildGame();
        $this->setHand(['thief', 'copper@4']);
        $this->setOpponentDeck(['copper', 'silver']);
        $this->playCard('thief');

        $this->assertStringContainsString(
            'Lucy reveals a Copper and a Silver from the top of their deck. Which do you trash?',
            $this->buildView()
        );
        $this->assertStringContainsString(
            'You reveal a Copper and a Silver from the top of your deck. Alec is deciding which one to trash...',
            $this->buildView(true)
        );

        $this->provideInput('silver');

        $this->assertStringContainsString(
            'Do you want to gain the trashed Silver?',
            $this->buildView()
        );

        $this->assertStringContainsString(
            'Alec is deciding whether or not to gain the trashed Silver',
            $this->buildView(true)
        );
    }

}