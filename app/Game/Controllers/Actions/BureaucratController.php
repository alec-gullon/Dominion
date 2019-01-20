<?php

namespace App\Game\Controllers\Actions;

class BureaucratController extends ActionController {

    public function play() {
        $this->gainCard('silver', $this->activePlayer(), 'deck');

        if ($this->state->hasMoat()) {
            $this->nextStep('resolve-moat');
            $this->inputOn(false);
            return;
        }
        $this->resolveAttackIfNecessary();
    }

    public function resolveMoat($revealed) {
        if ($revealed) {
            return $this->revealMoat();
        }
        return $this->resolveAttackIfNecessary();
    }

    public function resolveAttack($stub) {
        $this->moveCardOntoDeck('hand', $stub, $this->secondaryPlayer());
        $this->resolveCard();
    }

    private function resolveAttackIfNecessary() {
        if(!$this->secondaryPlayer()->hasCardsOfType('victory')) {
            $this->describeHand($this->secondaryPlayer());
            return $this->resolveCard();
        }
        $this->nextStep('resolve-attack');
        $this->inputOn(false);
    }

}