<?php

namespace App\Game\Controllers;

/**
 * Controller responsible for updating game state when a player ends their turn
 */
class TurnController extends StateController {

    /**
     * Updates state when a user selects to end their turn
     */
    public function endTurn() {
        $this->addToLog('ends their turn', null, 0);
        $this->state->advanceTurn();

        if ($this->state->checkGameOver()) {
            $this->state->isResolved = true;
        }
    }

}