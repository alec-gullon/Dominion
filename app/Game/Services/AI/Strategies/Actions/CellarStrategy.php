<?php

namespace App\Game\Services\AI\Strategies\Actions;

/**
 * Provides the AI with an appropriate decision to resolve a Cellar card that has been played
 */
class CellarStrategy extends CardStrategy {

    public function discardSelectedCards() {
        $handCards = $this->state->activePlayer()->hand();
        $prioritisedCards = $this->prioritiseCards($handCards);

        $cardsToDiscard = [];
        foreach ($prioritisedCards as $prioritisedCard) {
            if ($prioritisedCard['priority'] > 0) {
                $cardsToDiscard[] = $prioritisedCard['instance']->stub();
            }
        }

        return $cardsToDiscard;
    }

    public function cardPriority($card) {
        $priority = 0;
        if ($card->hasType('curse'))            $priority += 100;
        if ($card->hasType('victory'))          $priority += 10;
        return $priority;
    }

}