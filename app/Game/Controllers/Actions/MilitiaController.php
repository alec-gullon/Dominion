<?php

namespace App\Game\Controllers\Actions;

class MilitiaController extends ActionController {

    private $numberMappings = ['no', 'one', 'two', 'three'];

    public function play() {
        $this->addCoins(2);

        if ($this->state->hasMoat()) {
            $this->setNextStep('resolve-moat');
            return $this->inputOn(false);
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
        $cardsInHand = $this->secondaryPlayer()->numberOfCards();

        if ($cardsInHand > 3) {
            $this->setNextStep('resolve-attack');
            return $this->inputOn(false);
        }

        $message = 'is unaffected since they have ' . $this->numberMappings[$cardsInHand] . ' cards in hand';
        $this->addPlayerActionToLog($message, $this->secondaryPlayer());
        $this->resolveCard();
    }

}