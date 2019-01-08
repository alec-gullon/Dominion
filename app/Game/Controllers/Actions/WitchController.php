<?php

namespace App\Game\Controllers\Actions;

class WitchController extends ActionController {

    public function play() {
        $this->drawCards(2);

        if ($this->state->hasMoat()) {
            $this->nextStep('resolve-moat');
            return $this->inputOn();
        }
        return $this->nextStep('resolve-attack');
    }

    public function resolveMoat($revealed) {
        if ($revealed) {
            $this->revealMoat();
            return $this->resolveCard();
        }
        $this->nextStep('resolve-attack');
        return $this->inputOff();
    }

    public function resolveAttack() {
        if ($this->state->getKingdomCards()['curse'] > 0) {
            $this->state->moveCardToPlayer('curse', 'discard', $this->state->getSecondaryPlayerKey());
            $this->addToLog('.. ' . $this->secondaryPlayer()->getName() . ' gains a Curse');
        } else {
            $this->addToLog('.. ' . $this->secondaryPlayer()->getName() . ' gains nothing since Curse pile is empty');
        }
        $this->resolveCard();
    }

}