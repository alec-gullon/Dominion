<?php

namespace App\Game\Controllers\Actions;

class MineController extends ActionController {

    public function play() {
        if($this->activePlayer()->hasCardsOfType('treasure')) {
            $this->nextStep('trash-treasure');
            return $this->inputOn();
        }
        $this->addPlayerActionToLog('has nothing to trash');
        $this->resolveCard();
    }

    public function trashTreasure($stub) {
        $mineCard = $this->activePlayer()->getUnresolvedCard();
        $trashedCard = $this->cardBuilder->build($stub);

        $this->trashCards([$stub]);
        $mineCard->treasureValue = $trashedCard->getValue() + 3;

        $cheapestTreasure = $this->state->cheapestCardAmount('treasure');

        if ($cheapestTreasure !== null) {
            $this->nextStep('gain-treasure');
            return $this->inputOn();
        }
        $this->addPlayerActionToLog('has no cards which they can gain');
        $this->resolveCard();
    }

    public function gainTreasure($stub) {
        $this->gainCard($stub, $this->activePlayer(), 'hand');
        $this->resolveCard();
    }

    protected function resolveCard() {
        $card = $this->activePlayer()->getUnresolvedCard();
        $card->treasureValue = 0;
        parent::resolveCard();
    }

}