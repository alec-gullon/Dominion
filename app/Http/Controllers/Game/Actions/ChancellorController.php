<?php

namespace App\Http\Controllers\Game\Actions;

class ChancellorController extends ActionController {

    public function play() {
        $this->nextStep('put-deck-in-discard');
        $this->state->addCoins(2);
        $this->inputOn();
    }

    public function putDeckInDiscard() {
        $this->activePlayer()->moveCards('deck', 'discard');
        $this->resolveCard();
    }

}