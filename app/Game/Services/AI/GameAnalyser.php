<?php

namespace App\Game\Services\AI;

use App\Models\Game\State;

class GameAnalyser {

    private $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function canPlayTreasureCard() {
        if (!$this->canplayActionCard() && $this->state->activePlayer()->hasCardsOfType('treasure')) {
            return true;
        }
        return false;
    }

    public function canPlayActionCard() {
        return ($this->state->actions() > 0 && $this->state->activePlayer()->hasCardsOfType('action'));
    }

    public function canBuyCard() {
        return ($this->state->phase() === 'buy' && $this->state->buys() > 0);
    }

    public function chooseActionCardToPlay() {
        $cards = $this->state->activePlayer()->hasCardsOfType('action');

        foreach ($cards as $card) {
            if ($card->hasFeature('increasesActions')) {
                return $card->stub();
            }
        }

        foreach ($cards as $card) {
            if ($card->hasFeature('cantrip')) {
                return $card->stub();
            }
        }

        foreach ($cards as $card) {
            if ($card->hasType('attack')) {
                return $card->stub();
            }
        }

        return $cards[0];
    }

}