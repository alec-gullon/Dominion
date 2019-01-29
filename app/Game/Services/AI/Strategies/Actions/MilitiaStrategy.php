<?php

namespace App\Game\Services\AI\Strategies\Actions;

/**
 * Provides the AI with an appropriate decision to resolve a Militia card that has been played
 */
class MilitiaStrategy extends CardStrategy {

    public function resolveAttack() {
        $handCards = $this->secondaryPlayer()->hand();

        $prioritisedCards = $this->prioritiseCards($handCards);

        $cardsToDiscard = [];
        for ($i = 0; $i < count($handCards) - 3; $i++) {
            $cardsToDiscard[] = $prioritisedCards[$i]['instance']->stub();
        }

        return $cardsToDiscard;
    }

    /**
     * Assigns a priority for when the decision about what cards to discard is being made.
     * Priority is given to victory and curse cards, followed by cards of a lower value
     *
     * @param   object      $card
     *
     * @return  int
     */
    protected function cardPriority($card) {
        $priority = 10 - $card->value();
        if ($card->stub() === 'curse')              $priority += 100;
        if ($card->hasType('victory'))              $priority += 10;
        return $priority;
    }

}