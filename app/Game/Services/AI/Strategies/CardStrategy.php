<?php

namespace App\Game\Services\AI\Strategies;

use App\Models\Game\State;

class CardStrategy {

    protected $state;

    protected $cardBuilder;

    public function __construct(State $state) {
        $this->state = $state;
        $this->cardBuilder = resolve('\App\Services\CardBuilder');
    }

    public function resolveMoat() {
        return true;
    }

}