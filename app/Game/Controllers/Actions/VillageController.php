<?php

namespace App\Game\Controllers\Actions;

/**
 * Controller responsible for resolving the Village card when it has been played
 */
class VillageController extends ActionController {

    /**
     * Adjusts game state in line with a Village card
     */
    public function play() {
        $this->addActions(2);
        $this->drawCards(1);
        $this->resolveCard();
    }

}