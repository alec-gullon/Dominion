<?php

namespace App\Game\Services\AI\Strategies;

use App\Game\Models\State;

use App\Game\Helpers\StringHelper;

class ActionStrategy {

    private $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    public function isRequired() {
        return $this->state->activePlayer()->hasUnresolvedCard();
    }

    public function decision() {
        $alias = $this->state->activePlayer()->unresolvedCard()->alias();
        $nextStep = $this->state->activePlayer()->getNextStep();
        $method = StringHelper::methodFromNextStep($nextStep);

        $strategy = 'App\Game\Services\AI\Strategies\Actions\\' . $alias . 'Strategy';
        $strategy = new $strategy($this->state);
        return [
            'action' => 'provide-input',
            'input' => $strategy->$method()
        ];
    }

}