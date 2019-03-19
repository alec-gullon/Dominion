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
        return [
            'action' => 'play-all-treasures',
            'input' => null
        ];
    }

}