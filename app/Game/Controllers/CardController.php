<?php

namespace App\Game\Controllers;

/**
 * Controller responsible for updating game state when a player plays an action card from their hand
 */
class CardController extends StateController {

    /**
     * Plays the card corresponding to the provided $stub from the player's hand
     *
     * @param   string      $stub
     */
    public function play($stub) {
        $this->playCard($stub);
        $this->state->actions -= 1;
    }

}