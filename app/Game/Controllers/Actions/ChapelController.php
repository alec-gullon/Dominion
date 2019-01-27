<?php

namespace App\Game\Controllers\Actions;

class ChapelController extends ActionController {

    public function play() {
        if ($this->activePlayer()->hasEmptyHand()) {
            $this->addPlayerActionToLog('has nothing to trash');
            return $this->resolveCard();
        }
        $this->setNextStep('trash-selected-cards');
        $this->inputOn();
    }

    public function trashSelectedCards($stubs) {
        $this->trashCards($stubs);
        $this->resolveCard();
    }

}