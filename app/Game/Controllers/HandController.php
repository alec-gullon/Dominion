<?php

namespace App\Game\Controllers;

class HandController extends StateController {

    public function playTreasure($stub) {
        $this->state->activePlayer()->playCard($stub);
        $card = $this->cardBuilder->build($stub);
        $this->state->addCoins($card->getDenomination());
        $this->state->activePlayer()->resolveAll();
        $this->state->setPhase('buy');
    }

}