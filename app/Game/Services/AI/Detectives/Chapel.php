<?php

namespace App\Game\Services\AI\Detectives;

class Chapel extends CardDetective {

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

        return [
            'action' => 'provide-input',
            'input' => $cardsToTrash
        ];
    }

}