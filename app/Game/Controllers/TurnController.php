<?php

namespace App\Game\Controllers;

class TurnController extends StateController {

    public function endTurn() {
        $this->activePlayer()->moveCards('hand', 'discard');
        $this->activePlayer()->moveCards('played', 'discard');
        $this->activePlayer()->drawCards(5);

        $this->state->advanceTurn();
        $this->addPlayerActionToLog('ends their turn');

        $this->state->setActivePlayerId($this->state->secondaryPlayer()->id());

        if ($this->state->checkGameOver()) {
            $this->state->resolveGame();
        }
    }

}