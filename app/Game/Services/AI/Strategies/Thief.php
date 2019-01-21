<?php

namespace App\Game\Services\AI\Strategies;

class Thief extends CardStrategy {

    public function resolveAttack() {
        $revealedCards = $this->state->secondaryPlayer()->revealed();

        if ($revealedCards[0]->getValue() < $revealedCards[1]->getValue()) {
            return $revealedCards[1]->stub();
        }
        return $revealedCards[0]->stub();
    }

    public function gainTrashedCard() {
        $thiefCard = $this->state->activePlayer()->unresolvedCard();

        $card = $this->cardBuilder->build($thiefCard->trashedCard);

        if ($card->getValue() >= 3) {
            return true;
        }
        return false;
    }

}