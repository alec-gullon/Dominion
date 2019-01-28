<?php

namespace App\Game\Services\AI\Strategies\Actions;

class Bureaucrat extends CardStrategy {

    public function resolveAttack() {
        $handCards = $this->state->activePlayer()->hand();

        foreach ($handCards as $handCard) {
            if ($handCard->hasType('victory')) {
                return $handCard->stub();
            }
        }
    }

}