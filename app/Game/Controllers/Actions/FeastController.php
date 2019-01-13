<?php

namespace App\Game\Controllers\Actions;

class FeastController extends ActionController {

    public function play() {
        $feastCard = $this->activePlayer()->unresolvedCard();

        if (!$feastCard->isVirtual()) {
            $this->addPlayerActionToLog('trashes the Feast');
        }

        $this->nextStep('gain-selected-card');
        $this->inputOn();
    }

    public function gainSelectedCard($stub) {
        $feastCard = $this->activePlayer()->unresolvedCard();

        $this->gainCard($stub);
        if (!$feastCard->isVirtual()) {
            $this->state->trashCard('feast', 'played');
        } else {
            $this->resolveCard();
        }
    }

}