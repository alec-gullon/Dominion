<?php

namespace App\Game\Controllers\Actions;

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

        $userCanSelectCard = false;

        $cards = $this->state->getKingdomCards();
        foreach ($cards as $stub => $amount) {
            $card = $this->cardBuilder->build($stub);

            if ($card->hasType('treasure') && $card->getValue() <= $mineCard->treasureValue && $amount > 0) {
                $userCanSelectCard = true;
                break;
            }
        }

        if ($userCanSelectCard) {
            $this->nextStep('gain-treasure');
            $this->inputOn();
        } else {
            $this->resolveCard();
        }
    }

    public function gainTreasure($stub) {
        $mineCard = $this->activePlayer()->getUnresolvedCard();

        $this->state->moveCardToPlayer($stub, 'hand');
        $mineCard->treasureValue = 0;
        $this->resolveCard();
    }

}