<?php

namespace App\Game\Services\AI\Detectives;

class Library extends CardDetective {

    public function setAsideCard() {
        $actionCardsInHand = $this->state->activePlayer()->getCardsOfType('hand', 'action');
        $actionCardsInHand = count($actionCardsInHand);

        $decision = false;
        if ($actionCardsInHand <= $this->state->actions()) {
            $decision = true;
        }
        return [
            'action' => 'provide-input',
            'input' => $decision
        ];

    }

}