<?php

namespace App\Game\Services\AI\Detectives;

use App\Models\Game\State;

class Workshop {

    private $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    public function decide() {
        // if it's a game ending situation, grab an estate, otherwise gain a random 4 cost card
        if ($this->state->checkGameOver() && $this->state->hasCard('estate')) {
            return [
                'action' => 'provide-input',
                'input' => 'estate'
            ];
        }
    }

}