<?php

namespace App\Game\Controllers\Actions;

class CellarController extends ActionController {

    public function play() {
        $this->state->addActions(1);
        $this->nextStep('discard-cards');
        $this->inputOn();
    }

    public function discardCards($cards) {
        $this->activePlayer()->discardCards($cards);
        $this->activePlayer()->drawCards(count($cards));
        $this->resolveCard();
    }

}