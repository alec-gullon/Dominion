<?php

namespace App\Game\Controllers\Actions;

class ChapelController extends ActionController {

    public function play() {
        if ($this->activePlayer()->countHand() === 0) {
            $this->addToLog('.. ' . $this->activePlayer()->getName() . ' has nothing to trash');
            $this->resolveCard();
            return;
        }
        $this->nextStep('trash-selected-cards');
        $this->inputOn();
    }

    public function trashSelectedCards($stubs) {
        $this->trashCards($stubs);
        $this->resolveCard();
    }

}