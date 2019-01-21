<?php

namespace App\Game\Services\AI\Strategies;

class Bureaucrat extends CardStrategy {

    public function resolveAttack() {
        $handCards = $this->state->activePlayer()->getHand();

        foreach ($handCards as $handCard) {
            if ($handCard->hasType('victory')) {
                return $handCard->stub();
            }
        }
    }

}