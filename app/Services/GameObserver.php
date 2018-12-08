<?php

namespace App\Services;

use App\Models\Game\State;

class GameObserver {

    private $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    public function playerAreaView($state, $playerKey) {
        $nextStep = $state->getActivePlayer()->getNextStep();

        if (null === $nextStep) {
            return 'hand';
        }
        if (strpos($nextStep, 'resolve-moat') !== false) {
            return 'general/resolve-moat';
        }
        return $nextStep;
    }

    public function isHandCardActive($state, $card, $playerKey) {
        if ($state->getActivePlayerKey() !== $playerKey) {
            return false;
        }
        if ($card->hasType('victory')) {
            return false;
        }
        if ($state->getActions() === 0 && $card->hasType('action')) {
            return false;
        }
        if ($state->getPhase() !== 'action' && $card->hasType('action')) {
            return false;
        }
        return true;
    }

    public function canBuy($stub) {
        $cardBuilder = new CardBuilder();
        $card = $cardBuilder->build($stub);

        if ($this->state->getPhase() !== 'buy') {
            return false;
        }
        if ($card->getValue() > $this->state->getCoins() || $this->state->getBuys() === 0) {
            return false;
        }
        return true;
    }

}