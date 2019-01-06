<?php

namespace App\Game\Controllers\Actions;

class CellarController extends ActionController {

    public function play() {
        $this->state->addActions(1);

        if (count($this->activePlayer()->getHand()) === 0) {
            $this->resolveCard();
            return;
        }
        $this->nextStep('discard-cards');
        $this->inputOn();
    }

    public function discardCards($cards) {
        $this->activePlayer()->discardCards($cards);
        $this->activePlayer()->drawCards(count($cards));
        $this->resolveCard();
    }

}