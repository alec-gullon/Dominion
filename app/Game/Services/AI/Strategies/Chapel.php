<?php

namespace App\Game\Services\AI\Strategies;

class Chapel extends CardStrategy {

    private $trashableCards = [
        'estate',
        'curse',
        'copper'
    ];

    public function trashSelectedCards() {
        $handCards = $this->state->activePlayer()->getHand();

        $cardsToTrash = [];
        foreach ($handCards as $handCard) {
            if (in_array($handCard->stub(), $this->trashableCards)) {
                $cardsToTrash[] = $handCard->stub();
            }
        }

        return $cardsToTrash;
    }

}