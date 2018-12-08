<?php

namespace App\Http\Controllers\Game;

class MilitiaController extends ActionController {

    public function play() {
        $this->state->addCoins(2);

        if ($this->state->hasMoat()) {
            $this->nextStep('resolve-moat');
            $this->inputOn();
            return;
        }
        $this->resolveAttackIfNecessary();
    }

    public function resolveMoat($revealed) {
        if ($revealed) {
            $this->resolveCard();
            return;
        }
        $this->resolveAttackIfNecessary();
    }

    public function resolveAttack($cards) {
        $this->secondaryPlayer()->discardCards($cards);
        $this->resolveCard();
    }

    private function resolveAttackIfNecessary() {
        if (count($this->secondaryPlayer()->getHand()) > 3) {
            $this->nextStep('resolve-attack');
            $this->inputOn();
            return;
        }
        $this->resolveCard();
    }

}