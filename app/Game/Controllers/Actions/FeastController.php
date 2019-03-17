<?php

namespace App\Game\Controllers\Actions;

class FeastController extends ActionController {

    public function play() {
        $feastCard = $this->activePlayer()->unresolvedCard();

        if (!$feastCard->isVirtual) {
            $this->addToLog('trashes the Feast');
        }

        $this->setNextStep('gain-selected-card');
        $this->inputOn();
    }

    public function gainSelectedCard($stub) {
        $feastCard = $this->activePlayer()->unresolvedCard();

        $this->gainCard($stub);
        if (!$feastCard->isVirtual) {
            $this->state->trashCard('feast', 'played');
            $this->inputOff();
        } else {
            $this->resolveCard();
        }
    }

}