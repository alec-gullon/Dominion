<?php

namespace App\Game\Services\AI\Strategies;

class Cellar extends CardStrategy {

    public function discardSelectedCards() {
        $handCards = $this->state->activePlayer()->hand();

        $cardsToDiscard = [];
        foreach ($handCards as $handCard) {
            if ($handCard->hasType('victory') || $handCard->stub() === 'curse') {
                $cardsToDiscard[] = $handCard->stub();
            }
        }

        return $cardsToDiscard;
    }

}