<?php

namespace App\Game\Services\AI\Strategies;

use App\Game\Models\State;

class TreasureStrategy {

    private $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    public function isRequired() {
        if ($this->state->activePlayer()->hasCardsOfType('treasure')) {
            return true;
        }
        return false;
    }

    public function decision() {
        $input = $this->decideWhatTreasureCardToPlay();
        return [
            'action' => 'play-treasure',
            'input' => $input
        ];
    }

    private function decideWhatTreasureCardToPlay() {
        $treasureCards = $this->state->activePlayer()->getCardsOfType('hand', 'treasure');
        return $treasureCards[0]->stub();
    }



}