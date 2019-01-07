<?php

namespace App\Game\Controllers\Actions;

class CellarController extends ActionController {

    public function play() {
        $this->state->addActions(1);

        if (count($this->activePlayer()->getHand()) === 0) {
            $this->addToLog('.. ' . $this->activePlayer()->getName() . ' has nothing to discard');
            $this->resolveCard();
            return;
        }
        $this->nextStep('discard-selected-cards');
        $this->inputOn();
    }

    public function discardSelectedCards($cards) {
        $this->discardCards($cards);
        $this->drawCards(count($cards));
        $this->resolveCard();
    }

}