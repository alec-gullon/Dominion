<?php

namespace App\Game\Controllers;

/**
 * Controller responsible for handling the situation where a player plays a treasure card
 */
class TreasureController extends StateController {

    /**
     * Updates the state when a player has played a treasure card represented by the given $stub
     *
     * @param   string      $stub
     */
    public function playTreasure($stub) {
        $card = $this->buildCard($stub);

        $this->playCard($stub);
        $this->state->coins += $card->denomination();
        $this->state->phase = 'buy';
    }

}