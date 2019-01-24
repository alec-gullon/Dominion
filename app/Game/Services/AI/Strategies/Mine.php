<?php

namespace App\Game\Services\AI\Strategies;

class Mine extends CardStrategy {

    public function trashTreasure() {
        $handCards = $this->state->activePlayer()->hand();

        foreach ($handCards as $card) {
            if ($card->hasType('treasure') && $card->stub() !== 'gold') {
                return $card->stub();
            }
        }

        return 'gold';
    }

    public function gainTreasure() {
        $unresolvedCard = $this->state->activePlayer()->unresolvedCard();

        if ($unresolvedCard->treasureValue === 3) {
            return 'silver';
        }
        return 'gold';
    }

}