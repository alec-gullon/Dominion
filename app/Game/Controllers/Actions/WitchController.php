<?php

namespace App\Game\Controllers\Actions;

class WitchController extends ActionController {

    public function play() {
        $this->drawCards(2);

        if ($this->state->hasMoat()) {
            $this->setNextStep('resolve-moat');
            return $this->inputOn(false);
        }
        $this->setNextStep('resolve-attack');
    }

    public function resolveMoat($revealed) {
        if ($revealed) {
            $this->revealMoat();
            return $this->resolveCard();
        }
        $this->setNextStep('resolve-attack');
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