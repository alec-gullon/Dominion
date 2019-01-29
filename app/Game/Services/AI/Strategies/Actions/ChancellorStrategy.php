<?php

namespace App\Game\Services\AI\Strategies\Actions;

/**
 * Provides the AI with an appropriate decision to resolve a Chancellor card that has been played
 */
class ChancellorStrategy extends CardStrategy {

    public function putDeckInDiscard() {
        return true;
    }

}