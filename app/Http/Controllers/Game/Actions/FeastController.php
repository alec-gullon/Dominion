<?php

namespace App\Http\Controllers\Game\Actions;

class FeastController extends ActionController {

    public function play() {
        $feastCard = $this->activePlayer()->getUnresolvedCard();

        $this->nextStep('gain-card');
        if (!$feastCard->isVirtual()) {
            $this->state->trashCard('feast', 'played');
        }
        $this->inputOn();
    }

    public function gainCard($stub) {
        $this->state->moveCardToPlayer($stub);
        $this->resolveCard();
    }

}