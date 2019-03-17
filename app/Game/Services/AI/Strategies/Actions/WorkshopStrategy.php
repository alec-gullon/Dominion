<?php

namespace App\Game\Services\AI\Strategies\Actions;

/**
 * Provides the AI with an appropriate decision to resolve a Bureaucrat card that has been played
 */
class WorkshopStrategy extends CardStrategy {

    public function gainSelectedCard() {
        $cardStack = $this->remainingKingdomCardStack();
        return $this->prioritisedCard($cardStack);
    }

    /**
     * Assign a priority to what card should be gained. If the game is drawing to a close,
     * grab an estate to try and force a win
     *
     * @param   object      $card
     *
     * @return  int
     */
    protected function cardPriority($card) {
        $priority = $card->value;
        if ($this->state->checkGameOver() && $card->stub === 'estate')    $priority += 10;
        if ($card->value > 4)                                             $priority = -1;

        return $priority;
    }

}