<?php

namespace App\Game\Controllers\Actions;

/**
 * Controller responsible for resolving the Festival card when it has been played
 */
class FestivalController extends ActionController {

    /**
     * Adjusts game state in line with a Festival card
     */
    public function play() {
        $this->addActions(2);
        $this->addCoins(2);
        $this->addBuys(1);
        $this->resolveCard();
    }

}