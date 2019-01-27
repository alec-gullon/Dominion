<?php

namespace App\Game\Controllers\Actions;

/**
 * Controller responsible for resolving the Bureaucrat card when it has been played
 */
class BureaucratController extends ActionController {

    /**
     * Resolves the initial effects when the card is initially played
     */
    public function play() {
        $this->gainCard('silver', null, 'deck');

        if ($this->state->hasMoat()) {
            $this->setNextStep('resolve-moat');
            return $this->inputOn(false);
        }
        return $this->resolveAttackIfNecessary();
    }

    /**
     * Resolves the card according to if the player revealed a moat or not
     *
     * @param   bool        $revealed
     */
    public function resolveMoat($revealed) {
        if ($revealed) {
            $this->revealMoatDescription();
            return $this->resolveCard();
        }
        return $this->resolveAttackIfNecessary();
    }

    /**
     * Discards the card indicated by the provided $stub from the player's hand
     *
     * @param   string      $stub
     */
    public function resolveAttack($stub) {
        $this->moveCardOntoDeck('hand', $stub, $this->secondaryPlayer());
        $this->resolveCard();
    }

    /**
     * Checks if it is necessary to prompt the player to select a victory card from their hand,
     * and if not, goes ahead and automatically resolves the card
     */
    private function resolveAttackIfNecessary() {
        if(!$this->secondaryPlayer()->hasCardsOfType('victory')) {
            $this->describeHand($this->secondaryPlayer());
            return $this->resolveCard();
        }
        $this->setNextStep('resolve-attack');
        return $this->inputOn(false);
    }

}