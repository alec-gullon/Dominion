<?php

namespace App\Game\Controllers\Actions;

/**
 * Controller responsible for resolving the Moat card when it has been played
 */
class MoatController extends ActionController {

    /**
     * Adjusts game state in line with a Moat card
     */
    public function play() {
        $this->drawCards(2);
        $this->resolveCard();
    }

}