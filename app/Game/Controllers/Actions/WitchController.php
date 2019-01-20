<?php

namespace App\Game\Controllers\Actions;

class WitchController extends ActionController {

    public function play() {
        $this->drawCards(2);

        if ($this->state->hasMoat()) {
            $this->nextStep('resolve-moat');
            return $this->inputOn(false);
        }
        $this->nextStep('resolve-attack');
    }

    public function resolveMoat($revealed) {
        if ($revealed) {
            return $this->revealMoat();
        }
        $this->nextStep('resolve-attack');
        $this->inputOff();
    }

    public function resolveAttack() {
        if ($this->state->kingdomCards()['curse'] > 0) {
            $this->gainCard('curse', $this->secondaryPlayer());
        } else {
            $this->addPlayerActionToLog('gains nothing since Curse pile is empty', $this->secondaryPlayer());
        }
        $this->resolveCard();
    }

}