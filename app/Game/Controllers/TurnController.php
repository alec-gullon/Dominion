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
        $this->addPlayerActionToLog('ends their turn');

        $this->state->setActivePlayerId($this->state->secondaryPlayer()->getId());

        if ($this->state->checkGameOver()) {
            $this->state->resolveGame();
        }
    }

}