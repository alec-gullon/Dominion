<?php

namespace App\Game\Services\AI;

use App\Models\Game\State;
use App\Services\CardBuilder;

class Detective {

    private $state;

    private $gameAnalyser;

    private $cardBuilder;

    public function __construct(State $state, GameAnalyser $gameAnalyser, CardBuilder $cardBuilder) {
        $this->state = $state;
        $this->gameAnalyser = $gameAnalyser;
        $this->cardBuilder = $cardBuilder;
    }

    public function decision() {

        if ($this->state->activePlayer()->hasUnresolvedCard()) {
            $unresolvedCard = $this->state->activePlayer()->unresolvedCard()->alias();
            $detective = 'App\Game\Services\AI\Detectives\\' . $unresolvedCard;
            $detective = new $detective($this->state);
            return $detective->decide();
        }

        // if we aren't resolving a card, start by playing an action card if possible
        if ($this->gameAnalyser->canPlayActionCard()) {

        }

    }

}