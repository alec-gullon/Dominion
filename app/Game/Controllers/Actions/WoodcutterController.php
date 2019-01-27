<?php

namespace App\Game\Controllers\Actions;

/**
 * Controller responsible for resolving the Woodcutter card when it has been played
 */
class WoodcutterController extends ActionController {

    /**
     * Adjusts game state in line with a Woodcutter card
     */
    public function play() {
        $this->addCoins(2);
        $this->addBuys(1);
        $this->resolveCard();
    }

}