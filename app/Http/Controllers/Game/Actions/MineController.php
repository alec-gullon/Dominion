<?php

namespace App\Http\Controllers\Game;

class MineController extends ActionController {

    public function play() {
        $this->nextStep('trash-treasure');
        $this->inputOn();
    }

    public function trashTreasure($stub) {
        $mineCard = $this->activePlayer()->getUnresolvedCard();
        $trashedCard = $this->cardBuilder->build($stub);

        $this->state->trashCard($stub);
        $mineCard->treasureValue = $trashedCard->getValue() + 3;

        $this->nextStep('gain-treasure');
        $this->inputOn();
    }

    public function gainTreasure($stub) {
        $mineCard = $this->activePlayer()->getUnresolvedCard();

        $this->state->moveCardToPlayer($stub, 'hand');
        $mineCard->treasureValue = 0;
        $this->resolveCard();
    }

}