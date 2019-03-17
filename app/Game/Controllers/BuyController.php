<?php

namespace App\Game\Controllers;

/**
 * Controller responsible for updating game state when a player buys a card or selects to advance into
 * the buy phase
 */
class BuyController extends StateController {

    /**
     * Advances the game to the buy phase
     */
    public function advanceToBuy() {
        $this->state->phase = 'buy';
    }

    /**
     * Updates the state when a player buys the card represented by $stub
     *
     * @param   string      $stub
     */
    public function buy($stub) {
        $card = $this->buildCard($stub);

        $this->state->coins -= $card->value;
        $this->state->buys -= 1;
        $this->buyCard($stub);
    }

}