<?php

namespace App\Game\Controllers\Actions;

class RemodelController extends ActionController {

    public function play() {
        // if player has another card in hand, let them trash something
        if ($this->activePlayer()->countHand() !== 0) {
            $this->nextStep('trash-card');
            $this->inputOn();
            return;
        }
        $this->addToLog('.. ' . $this->activePlayer()->getName() . ' has nothing to trash');
        $this->resolveCard();
    }

    public function trashCard($stub) {
        $remodelCard = $this->activePlayer()->getUnresolvedCard();
        $trashedCard = $this->cardBuilder->build($stub);

        $this->state->trashCard($stub);
        $this->trashCardsDescription([$stub]);
        $remodelCard->gainValue = $trashedCard->getValue() + 2;

        if ($this->state->cheapestCardAmount() > $remodelCard->gainValue) {
            $remodelCard->gainValue = 0;
            $this->addToLog('.. ' . $this->activePlayer()->getName() . ' cannot gain anything');
            $this->resolveCard();
            return;
        }
        $this->nextStep('gain-card');
        $this->inputOn();
    }

    public function gainCard($stub) {
        $remodelCard = $this->activePlayer()->getUnresolvedCard();
        $remodelCard->gainValue = 0;

        $this->state->moveCardToPlayer($stub);
        $this->gainCardDescription($stub);
        $this->resolveCard();
    }

}