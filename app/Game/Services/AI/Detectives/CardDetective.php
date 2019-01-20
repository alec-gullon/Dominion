<?php

namespace App\Game\Services\AI\Detectives;

use App\Models\Game\State;

class CardDetective {

    protected $state;

    protected $cardBuilder;

    public function __construct(State $state) {
        $this->state = $state;
        $this->cardBuilder = resolve('\App\Services\CardBuilder');
    }

}