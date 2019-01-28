<?php

namespace App\Game\Services\AI\Strategies\Actions;

class Chapel extends CardStrategy {

    private $trashableCards = [
        'estate',
        'curse',
        'copper'
    ];

    public function trashSelectedCards() {
        $handCards = $this->state->activePlayer()->hand();

        $cardsToTrash = [];
        foreach ($handCards as $handCard) {
            if (in_array($handCard->stub(), $this->trashableCards)) {
                $cardsToTrash[] = $handCard->stub();
            }
        }

        return $cardsToTrash;
    }

}