<?php

namespace App\Game\Services\AI\Strategies;

class Spy extends CardStrategy {

    public function discardCard() {
        $card = $this->state->activePlayer()->revealed()[0];

        if (    $card->hasType('victory')
            ||  $card->getValue() <= 2
        ) {
            return true;
        }
        return false;
    }

    public function discardOpponentCard() {
        $card = $this->state->secondaryPlayer()->revealed()[0];

        if (    $card->hasType('victory')
            ||  $card->getValue() <= 2
        ) {
            return false;
        }
        return true;
    }

}