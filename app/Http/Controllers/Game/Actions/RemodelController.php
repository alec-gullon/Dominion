<?php

namespace App\Http\Controllers\Game;

class RemodelController extends ActionController {

    public function play() {
        // if player has another card in hand, let them trash something
        if ($this->activePlayer()->countHand() !== 0) {
            $this->nextStep('trash-card');
            $this->inputOn();
            return;
        }
        $this->resolveCard();
    }

    public function trashCard($stub) {
        $remodelCard = $this->activePlayer()->getUnresolvedCard();
        $trashedCard = $this->cardBuilder->build($stub);

        $this->state->trashCard($stub);
        $remodelCard->gainValue = $trashedCard->getValue() + 2;

        $this->nextStep('gain-card');
        $this->inputOn();
    }

    public function gainCard($stub) {
        $remodelCard = $this->activePlayer()->getUnresolvedCard();
        $remodelCard->gainValue = 0;

        $this->state->moveCardToPlayer($stub);
        $this->resolveCard();
    }

}