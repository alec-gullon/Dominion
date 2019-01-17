<?php

namespace App\Game\Services\AI;

use App\Models\Game\State;

class GameAnalyser {

    private $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    public function canPlayActionCard() {
        return ($this->state->actions() > 0 && $this->state->activePlayer()->hasCardsOfType('action'));
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