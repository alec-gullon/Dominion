<?php

namespace App\Game\Controllers\Actions;

class CellarController extends ActionController {

    public function play() {
        $this->addActions(1);

        if ($this->activePlayer()->hasEmptyHand()) {
            $this->addPlayerActionToLog('has nothing to discard');
            return $this->resolveCard();
        }
        $this->nextStep('discard-selected-cards');
        $this->inputOn();
    }

    public function discardSelectedCards($cards) {
        $numberOfCards = count($cards);

        $this->discardCards($cards);
        if ($numberOfCards > 0) {
            $this->drawCards($numberOfCards);
        }
        $this->resolveCard();
    }

}