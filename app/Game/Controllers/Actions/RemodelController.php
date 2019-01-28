<?php

namespace App\Game\Controllers\Actions;

class RemodelController extends ActionController {

    public function play() {
        if (!$this->activePlayer()->hasEmptyHand()) {
            $this->setNextStep('trash-card');
            return $this->inputOn();
        }
        $this->addToLog('has nothing to trash');
        $this->resolveCard();
    }

    public function trashCard($stub) {
        $remodelCard = $this->activePlayer()->unresolvedCard();
        $trashedCard = $this->buildCard($stub);

        $this->trashCards([$stub]);
        $gainValue = $trashedCard->value() + 2;

        if ($this->state->cheapestCardAmount() > $gainValue) {
            $this->addToLog('cannot gain anything');
            return $this->resolveCard();
        }
        $remodelCard->gainValue = $gainValue;
        $this->setNextStep('gain-selected-card');
        $this->inputOn();
    }

    public function gainSelectedCard($stub) {
        $this->gainCard($stub);
        $this->resolveCard();
    }

    protected function resolveCard() {
        $card = $this->activePlayer()->unresolvedCard();
        $card->gainValue = 0;
        parent::resolveCard();
    }

}