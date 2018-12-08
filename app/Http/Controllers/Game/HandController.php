<?php

namespace App\Http\Controllers\Game;

class HandController extends StateController {

    public function playTreasure($stub) {
        $this->state->getActivePlayer()->playCard($stub);
        $card = $this->cardBuilder->build($stub);
        $this->state->addCoins($card->getDenomination());
        $this->state->getActivePlayer()->resolveAll();
        $this->state->setPhase('buy');
    }

}