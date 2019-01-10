<?php

namespace App\Game\Controllers\Actions;

class FeastController extends ActionController {

    public function play() {
        $feastCard = $this->activePlayer()->getUnresolvedCard();

        $this->nextStep('gain-selected-card');
        if (!$feastCard->isVirtual()) {
            $this->state->trashCard('feast', 'played');
            $this->trashCardsDescription(['feast']);
        }
        $this->inputOn();
    }

    public function gainSelectedCard($stub) {
        $this->gainCard($stub);
        $this->resolveCard();
    }

}