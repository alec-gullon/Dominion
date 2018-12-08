<?php

namespace App\Http\Controllers\Game;

class TurnController extends StateController {

    public function endTurn() {
        $this->activePlayer()->moveCards('hand', 'discard');
        $this->activePlayer()->moveCards('played', 'discard');
        $this->activePlayer()->drawCards(5);

        $this->state->setCoins(0);
        $this->state->setBuys(1);
        $this->state->advanceTurn();

        if ($this->state->getActivePlayerKey() === 'alec') {
            $this->state->setActivePlayerKey('lucy');
        } else {
            $this->state->setActivePlayerKey('alec');
        }

        if ($this->state->isGameOver()) {
            $this->state->resolveGame();
        }
    }

}