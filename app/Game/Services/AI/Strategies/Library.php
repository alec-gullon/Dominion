<?php

namespace App\Game\Services\AI\Strategies;

class Library extends CardStrategy {

    public function setAsideCard() {
        $actionCardsInHand = $this->state->activePlayer()->getCardsOfType('hand', 'action');
        $actionCardsInHand = count($actionCardsInHand);

        if ($actionCardsInHand <= $this->state->actions()) {
            return true;
        }
        return false;

    }

}