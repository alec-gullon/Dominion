<?php

namespace App\Game\Services\AI\Strategies\Actions;

/**
 * Provides the AI with an appropriate decision to resolve a Spy card that has been played
 */
class SpyStrategy extends CardStrategy {

    /**
     * Discard the card if it's a Victory card or if it of sufficiently low value
     *
     * @return bool
     */
    public function discardCard() {
        $card = $this->state->activePlayer()->revealed()[0];

        if ($card->hasType('victory') ||  $card->value() <= 2) {
            return true;
        }
        return false;
    }

    /**
     * Same logic as before, but this time make the opposing player keep the card
     *
     * @return bool
     */
    public function discardOpponentCard() {
        $card = $this->state->secondaryPlayer()->revealed()[0];

        if ($card->hasType('victory') ||  $card->value() <= 2) {
            return false;
        }
        return true;
    }

}