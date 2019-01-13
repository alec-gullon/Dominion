<?php

namespace App\Game\Controllers;

use App\Models\Game\State;
use App\Services\CardBuilder;

class StateController {

    protected $state;

    protected $cardBuilder;

    public function __construct(State $state, CardBuilder $cardBuilder) {
        $this->state = $state;
        $this->cardBuilder = $cardBuilder;
    }

    protected function activePlayer() {
        return $this->state->activePlayer();
    }

}