<?php

namespace App\Game\Controllers;

class TreasureController extends StateController {

    public function playTreasure($stub) {
        $card = $this->buildCard($stub);

        $this->activePlayer()->playCard($stub);
        $this->state->addCoins($card->denomination());
        $this->activePlayer()->resolveAll();
        $this->state->setPhase('buy');

        $this->addPlayerActionToLog('plays ' . $card->nameWithArticlePrefix());
    }

}