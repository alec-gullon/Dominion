<?php

namespace App\Game\Services\AI\Strategies\Actions;

/**
 * Provides the AI with an appropriate decision to resolve a Thief card that has been played
 */
class ThiefStrategy extends CardStrategy {

    /**
     * Select the most valuable treasure, if it is necessary to do so. Note that this method
     * will only be invoked if the playing of a thief card reveals two treasure cards
     *
     * @return  string
     */
    public function resolveAttack() {
        $revealedCards = $this->state->secondaryPlayer()->revealed();

        if ($revealedCards[0]->value() < $revealedCards[1]->value()) {
            return $revealedCards[1]->stub();
        }
        return $revealedCards[0]->stub();
    }

    /**
     * Gain the trashed card if it is a Silver/Gold card, otherwise decline
     *
     * @return bool
     */
    public function gainTrashedCard() {
        $thiefCard = $this->state->activePlayer()->unresolvedCard();

        $card = $this->makeCard($thiefCard->trashedCard);

        if ($card->value() >= 3) {
            return true;
        }
        return false;
    }

}