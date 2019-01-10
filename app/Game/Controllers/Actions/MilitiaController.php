<?php

namespace App\Game\Controllers\Actions;

class MilitiaController extends ActionController {

    public function play() {
        $this->addCoins(2);

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
        $this->resolveAttackIfNecessary();
    }

    public function resolveAttack($cards) {
        $this->discardCards($cards, $this->secondaryPlayer());
        $this->resolveCard();
    }

    private function resolveAttackIfNecessary() {
        if (count($this->secondaryPlayer()->getHand()) > 3) {
            $this->nextStep('resolve-attack');
            $this->inputOn();
            return;
        }

        $cardsInHand = count($this->secondaryPlayer()->getHand());
        $this->addToLog('.. '
            . $this->secondaryPlayer()->getName()
            . ' is unaffected since they have '
            . $this->numberMappings[$cardsInHand]
            . ' cards in hand'
        );
        $this->resolveCard();
    }

}