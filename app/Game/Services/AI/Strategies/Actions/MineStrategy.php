<?php

namespace App\Game\Services\AI\Strategies\Actions;

/**
 * Provides the AI with an appropriate decision to resolve a Mine card that has been played
 */
class MineStrategy extends CardStrategy {

    /**
     * Trash a Silver/Copper if one exists, otherwise the AI will have to trash a Gold
     *
     * @return  string
     */
    public function trashTreasure() {
        $handCards = $this->state->activePlayer()->hand();

        foreach ($handCards as $card) {
            if ($card->hasType('treasure') && $card->stub() !== 'gold') {
                return $card->stub();
            }
        }

        return 'gold';
    }

    /**
     * If a copper was trashed, grab a Silver card, otherwise get a Gold
     *
     * @return  string
     */
    public function gainTreasure() {
        $unresolvedCard = $this->state->activePlayer()->unresolvedCard();

        if ($unresolvedCard->treasureValue === 3) {
            return 'silver';
        }
        return 'gold';
    }

}