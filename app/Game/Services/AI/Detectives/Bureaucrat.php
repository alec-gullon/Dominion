<?php

namespace App\Game\Services\AI\Detectives;

class Bureaucrat extends CardDetective {

    public function resolveMoat() {
        return [
            'action' => 'provide-input',
            'input' => true
        ];
    }

    public function resolveAttack() {
        $handCards = $this->state->activePlayer()->getHand();

        foreach ($handCards as $handCard) {
            if ($handCard->hasType('victory')) {
                return [
                    'action' => 'provide-input',
                    'input' => $handCard->stub()
                ];
            }
        }
    }

}