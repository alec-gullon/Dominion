<?php

namespace App\Game\Controllers\Actions;

class MilitiaController extends ActionController {

    public function play() {
        $this->addCoins(2);

        if ($this->state->hasMoat()) {
            $this->nextStep('resolve-moat');
            return $this->inputOn();
        }
        $this->resolveAttackIfNecessary();
    }

    public function resolveMoat($revealed) {
        if ($revealed) {
            return $this->revealMoat();
        }
        $this->resolveAttackIfNecessary();
    }

    public function resolveAttack($cards) {
        $this->discardCards($cards, $this->secondaryPlayer());
        $this->resolveCard();
    }

    private function resolveAttackIfNecessary() {
        $cardsInHand = $this->secondaryPlayer()->numberOfCards();

        if ($cardsInHand > 3) {
            $this->nextStep('resolve-attack');
            return $this->inputOn();
        }

        $message = 'is unaffected since they have ' . $this->numberMappings[$cardsInHand] . ' cards in hand';
        $this->addPlayerActionToLog($message, $this->secondaryPlayer());
        $this->resolveCard();
    }

}