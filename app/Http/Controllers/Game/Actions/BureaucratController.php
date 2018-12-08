<?php

namespace App\Http\Controllers\Game\Actions;

class BureaucratController extends ActionController {

    public function play() {
        $this->state->moveCardOntoDeck('silver');

        if ($this->state->hasMoat()) {
            $this->nextStep('resolve-moat');
            $this->inputOn();
            return;
        }
        $this->resolveAttackIfNecessary();
    }

    public function resolveMoat($revealed) {
        if ($revealed) {
            return $this->resolveCard();
        }
        return $this->resolveAttackIfNecessary();
    }

    public function resolveAttack($stub) {
        $this->secondaryPlayer()->moveCardOntoDeck('hand', $stub);
        $this->resolveCard();
    }

    private function resolveAttackIfNecessary() {
        if ($this->secondaryPlayer()->hasCardsOfType('victory')) {
            $this->nextStep('resolve-attack');
            $this->inputOn();
            return;
        }
        $this->resolveCard();
    }

}