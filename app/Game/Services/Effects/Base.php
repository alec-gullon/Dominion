<?php

namespace App\Game\Services\Effects;

use App\Game\Helpers\CardsHelper;
use App\Game\Helpers\StringHelper;
use App\Game\Models\State;

class Base {

    protected $numberMappings;

    protected $state;

    protected $params;

    public function __construct(State $state, $params) {
        $this->state = $state;
        $this->params = $params;
        $this->numberMappings = config('dominion.number-mappings');
    }

    protected function addToLog($entry) {
        $this->state->log()->addEntry($entry);
    }

    protected function describeCardList($cardStack) {
        $cardStack = CardsHelper::sortCardStackByName($cardStack);
        return StringHelper::describeCardStack($cardStack);
    }

    protected function activePlayerName() {
        return $this->state->activePlayer()->getName();
    }

}