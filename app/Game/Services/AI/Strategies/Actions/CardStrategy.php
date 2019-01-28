<?php

namespace App\Game\Services\AI\Strategies\Actions;

use App\Game\Models\State;
use App\Game\Factories\CardFactory;

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