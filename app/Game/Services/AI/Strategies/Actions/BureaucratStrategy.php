<?php

namespace App\Game\Services\AI\Strategies\Actions;

/**
 * Provides the AI with an appropriate decision to resolve a Bureaucrat card that has been played
 */
class BureaucratStrategy extends CardStrategy {

    /**
     * This method will only be called if the secondary player has a victory card
     * in hand, so we can go ahead and assume it exists
     *
     * @return mixed
     */
    public function resolveAttack() {
        $victoryCards = $this->secondaryPlayer()->getCardsOfType('hand', 'victory');
        return $victoryCards[0]->stub;
    }

}