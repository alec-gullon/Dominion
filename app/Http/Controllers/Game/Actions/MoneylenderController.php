<?php

namespace App\Http\Controllers\Game;

class MoneylenderController extends ActionController {

    public function play() {
        // if we actually have coppers in hand, give the player a chance to trash them
        if ($this->activePlayer()->hasCard('copper')) {
            $this->nextStep('trash-copper');
            $this->inputOn();
            return;
        }
        $this->resolveCard();
    }

    public function trashCopper($choice) {
        if ($choice) {
            $this->state->trashCard('copper');
            $this->state->addCoins(3);
        }
        $this->resolveCard();
    }

}