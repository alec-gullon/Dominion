<?php

namespace App\Game\Controllers\Actions;

class FeastController extends ActionController {

    public function play() {
        $feastCard = $this->activePlayer()->getUnresolvedCard();

        $this->nextStep('gain-card');
        if (!$feastCard->isVirtual()) {
            $this->state->trashCard('feast', 'played');
            $this->trashCardsDescription(['feast']);
        }
        $this->inputOn();
    }

    public function gainCard($stub) {
        $this->state->moveCardToPlayer($stub);
        $this->gainCardDescription($stub, $this->activePlayer());
        $this->resolveCard();
    }

}