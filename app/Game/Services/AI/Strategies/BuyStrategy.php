<?php

namespace App\Game\Services\AI\Strategies;

use App\Game\Models\State;

class BuyStrategy {

    private $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    public function isRequired() {
        return ($this->state->phase() === 'buy' && $this->state->buys() > 0 && $this->state->coins() >= 3);
    }

    public function decision() {
        return [
            'action' => 'buy',
            'input' => 'silver'
        ];
    }

}