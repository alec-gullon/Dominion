<?php

namespace App\Game\Services\AI\Strategies\Actions;

use App\Game\Factories\CardFactory;

/**
 * Provides the AI with an appropriate decision to resolve a Feast card that has been played
 */
class FeastStrategy extends CardStrategy {

    public function gainSelectedCard() {
        $cardStack = $this->remainingKingdomCardStack();
        return $this->prioritisedCard($cardStack);
    }

    /**
     * Assigns an integer priority to the available cards to select. Priority is heavily weighted towards
     * gaining attack cards, followed by gaining any kind of action card
     *
     * @param $card
     * @return int
     */
    protected function cardPriority($card) {
        $priority = $card->value();
        if ($card->hasType('attack'))       $priority += 100;
        if ($card->hasType('action'))       $priority += 10;
        if ($card->value() > 5)             $priority = -1;

        return $priority;
    }

}