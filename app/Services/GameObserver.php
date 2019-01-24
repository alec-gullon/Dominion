<?php

namespace App\Services;

use App\Game\Models\State;
use App\Game\Factories\CardFactory;

class GameObserver {

    private $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    public function playerAreaView($state) {
        $nextStep = $state->activePlayer()->getNextStep();

        if (null === $nextStep) {
            return 'hand';
        }
        if (strpos($nextStep, 'resolve-moat') !== false) {
            return 'general/resolve-moat';
        }
        return $nextStep;
    }

    public function isHandCardActive($card, $playerKey) {
        if ($this->state->activePlayerId() !== $playerKey) {
            return false;
        }
        if ($card->hasType('victory')) {
            return false;
        }
        if ($this->state->actions() === 0 && $card->hasType('action')) {
            return false;
        }
        if ($this->state->phase() !== 'action' && $card->hasType('action')) {
            return false;
        }
        return true;
    }

    public function canBuy($stub, $playerKey) {
        if ($this->state->activePlayerId() !== $playerKey) {
            return false;
        }

        $card = CardFactory::build($stub);

        if ($this->state->phase() !== 'buy') {
            return false;
        }
        if ($card->value() > $this->state->coins() || $this->state->buys() === 0) {
            return false;
        }
        return true;
    }

}