<?php

namespace App\Game\Services\AI\Strategies\Actions;

/**
 * Provides the AI with an appropriate decision to resolve a Moneylender card that has been played
 */
class MoneylenderStrategy extends CardStrategy {

    /**
     * Trash a Copper card if one exists in hand, otherwise the AI will have to select false
     * as the default option
     *
     * @return  bool
     */
    public function trashCopper() {
        return $this->state->activePlayer()->hasCard('copper');
    }

}