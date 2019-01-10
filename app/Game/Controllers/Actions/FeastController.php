<?php

namespace App\Game\Controllers\Actions;

class FeastController extends ActionController {

    public function play() {
        $feastCard = $this->activePlayer()->getUnresolvedCard();

        if (!$feastCard->isVirtual()) {
            $this->state->trashCard('feast', 'played');
            $this->addPlayerActionToLog('trashes the Feast');
        }

        $this->nextStep('gain-selected-card');
        $this->inputOn();
    }

    public function gainSelectedCard($stub) {
        $this->gainCard($stub);
        $this->resolveCard();
    }

}