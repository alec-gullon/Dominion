<?php

namespace App\Game\Services\AI\Strategies\Actions;

/**
 * Provides the AI with an appropriate decision to resolve a Library card that has been played
 */
class LibraryStrategy extends CardStrategy {

    /**
     * The AI will set the card aside if they already have more action cards in their hand than
     * they have available actions to play
     *
     * @return bool
     */
    public function setAsideCard() {
        $actionCardsInHand = count($this->activePlayer()->getCardsOfType('hand', 'action'));

        if ($actionCardsInHand <= $this->state->actions) {
            return true;
        }
        return false;
    }

}