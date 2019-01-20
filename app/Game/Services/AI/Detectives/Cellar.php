<?php

namespace App\Game\Services\AI\Detectives;

class Cellar extends CardDetective {

    public function discardSelectedCards() {
        $handCards = $this->state->activePlayer()->getHand();

        $cardsToDiscard = [];
        foreach ($handCards as $handCard) {
            if ($handCard->hasType('victory') || $handCard->stub() === 'curse') {
                $cardsToDiscard[] = $handCard->stub();
            }
        }

        return [
            'action' => 'provide-input',
            'input' => $cardsToDiscard
        ];
    }

}