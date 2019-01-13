<?php

namespace App\Game\Controllers;

class TurnController extends StateController {

    public function endTurn() {
        $this->activePlayer()->moveCards('hand', 'discard');
        $this->activePlayer()->moveCards('played', 'discard');
        $this->activePlayer()->drawCards(5);

        $this->state->setCoins(0);
        $this->state->setBuys(1);
        $this->state->advanceTurn();

        $this->state->setActivePlayerId($this->state->secondaryPlayer()->getId());

        if ($this->state->isGameOver()) {
            $this->state->resolveGame();
        }
    }

}