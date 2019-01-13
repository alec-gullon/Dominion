<?php

namespace App\Game\Controllers;

class TreasureController extends StateController {

    public function playTreasure($stub) {
        $card = $this->cardBuilder->build($stub);

        $this->activePlayer()->playCard($stub);
        $this->state->addCoins($card->getDenomination());
        $this->activePlayer()->resolveAll();
        $this->state->setPhase('buy');

        $this->addPlayerActionToLog('plays ' . $card->nameWithArticlePrefix());
    }

}