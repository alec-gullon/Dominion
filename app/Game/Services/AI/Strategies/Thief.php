<?php

namespace App\Game\Services\AI\Strategies;

class Thief extends CardStrategy {

    public function resolveAttack() {
        $revealedCards = $this->state->secondaryPlayer()->revealed();

        if ($revealedCards[0]->value() < $revealedCards[1]->value()) {
            return $revealedCards[1]->stub();
        }
        return $revealedCards[0]->stub();
    }

    public function gainTrashedCard() {
        $thiefCard = $this->state->activePlayer()->unresolvedCard();

        $card = $this->makeCard($thiefCard->trashedCard);

        if ($card->value() >= 3) {
            return true;
        }
        return false;
    }

}