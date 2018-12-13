<?php

namespace App\Game\Controllers\Actions;

class WitchController extends ActionController {

    public function play() {
        $this->activePlayer()->drawCards(2);

        if ($this->state->hasMoat()) {
            $this->nextStep('resolve-moat');
            return $this->inputOn();
        }
        return $this->nextStep('resolve-attack');
    }

    public function resolveMoat($revealed) {
        if ($revealed) {
            return $this->resolveCard();
        }
        $this->nextStep('resolve-attack');
        return $this->inputOff();
    }

    public function resolveAttack() {
        $this->state->moveCardToPlayer('curse', 'discard', $this->state->getSecondaryPlayerKey());
        $this->resolveCard();
    }

}