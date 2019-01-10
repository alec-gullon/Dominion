<?php

namespace App\Game\Controllers\Actions;

class RemodelController extends ActionController {

    public function play() {
        if (!$this->activePlayer()->hasEmptyHand()) {
            $this->nextStep('trash-card');
            return $this->inputOn();
        }
        $this->addPlayerActionToLog('has nothing to trash');
        $this->resolveCard();
    }

    public function trashCard($stub) {
        $remodelCard = $this->activePlayer()->getUnresolvedCard();
        $trashedCard = $this->cardBuilder->build($stub);

        $this->trashCards([$stub]);
        $gainValue = $trashedCard->getValue() + 2;

        if ($this->state->cheapestCardAmount() > $gainValue) {
            $this->addPlayerActionToLog('cannot gain anything');
            return $this->resolveCard();
        }
        $remodelCard->gainValue = $gainValue;
        $this->nextStep('gain-selected-card');
        $this->inputOn();
    }

    public function gainSelectedCard($stub) {
        $this->gainCard($stub);
        $this->resolveCard();
    }

    protected function resolveCard() {
        $card = $this->activePlayer()->getUnresolvedCard();
        $card->gainValue = 0;
        parent::resolveCard();
    }

}