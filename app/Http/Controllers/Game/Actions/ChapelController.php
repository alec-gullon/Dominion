<?php

namespace App\Http\Controllers\Game\Actions;

class ChapelController extends ActionController {

    public function play() {
        if ($this->activePlayer()->countHand() === 0) {
            $this->resolveCard();
            return;
        }
        $this->nextStep('trash-cards');
        $this->inputOn();
    }

    public function trashCards($stubs) {
        $this->state->trashCards($stubs);
        $this->resolveCard();
    }

}