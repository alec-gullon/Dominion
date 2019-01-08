<?php

namespace App\Game\Controllers\Actions;

class MoneylenderController extends ActionController {

    public function play() {
        // if we actually have coppers in hand, give the player a chance to trash them
        $this->nextStep('trash-copper');
        $this->inputOn();
    }

    public function trashCopper($choice) {
        if ($choice) {
            $this->addToLog('.. ' . $this->activePlayer()->getName() . ' trashes a Copper and gains three coins');
            $this->state->trashCard('copper');
            $this->state->addCoins(3);
        } else {
            $this->addToLog('.. ' . $this->activePlayer()->getName() . ' does not trash anything');
        }
        $this->resolveCard();
    }

}