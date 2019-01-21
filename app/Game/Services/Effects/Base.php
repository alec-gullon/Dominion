<?php

namespace App\Game\Services\Effects;

use App\Game\Helpers\CardsHelper;
use App\Game\Helpers\StringHelper;
use App\Models\Game\State;
use App\Services\CardBuilder;

class Base {

    protected $numberMappings;

    protected $state;

    protected $cardBuilder;

    protected $params;

    public function __construct(State $state, CardBuilder $cardBuilder, $params) {
        $this->state = $state;
        $this->cardBuilder = $cardBuilder;
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

}