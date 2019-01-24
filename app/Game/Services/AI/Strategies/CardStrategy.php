<?php

namespace App\Game\Services\AI\Strategies;

use App\Game\Models\State;
use App\Services\Factories\CardFactory;

class CardStrategy {

    protected $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    public function resolveMoat() {
        return true;
    }

    protected function makeCard($stub) {
        return CardFactory::build($stub);
    }

}