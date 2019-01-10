<?php

namespace App\Game\Controllers\Actions;

class BureaucratController extends ActionController {

    public function play() {
        $this->gainCard('silver', $this->activePlayer(), 'deck');

        if ($this->state->hasMoat()) {
            $this->nextStep('resolve-moat');
            $this->inputOn();
            return;
        }
        $this->resolveAttackIfNecessary();
    }

    public function resolveMoat($revealed) {
        if ($revealed) {
            $this->revealMoat();
            return $this->resolveCard();
        }
        return $this->resolveAttackIfNecessary();
    }

    public function resolveAttack($stub) {
        $this->moveCardOntoDeck('hand', $stub, $this->secondaryPlayer());
        $this->resolveCard();
    }

    private function resolveAttackIfNecessary() {
        if ($this->secondaryPlayer()->hasCardsOfType('victory')) {
            $this->nextStep('resolve-attack');
            $this->inputOn();
        } else {
            $this->describeHand($this->secondaryPlayer());
            $this->resolveCard();
        }
    }

}