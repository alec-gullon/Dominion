<?php

namespace App\Game\Services\AI;

use App\Models\Game\State;
use App\Services\CardBuilder;

class Detective {

    private $state;

    private $gameAnalyser;

    private $cardBuilder;

    public function __construct(GameAnalyser $gameAnalyser, CardBuilder $cardBuilder) {
        $this->gameAnalyser = $gameAnalyser;
        $this->cardBuilder = $cardBuilder;
    }

    public function setState($state) {
        $this->state = $state;
        $this->gameAnalyser->setState($state);
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
            return;
        }

        // if we've got this far, time to play a treasure card if we have one
        if ($this->gameAnalyser->canPlayTreasureCard()) {
            $treasureCards = $this->state->activePlayer()->getCardsOfType('hand', 'treasure');
            return [
                'action' => 'play-treasure',
                'input' => $treasureCards[0]->stub()
            ];
        }

        // now we buy something if we can
        if ($this->gameAnalyser->canBuyCard()) {
            if ($this->state->coins() >= 3) {
                return [
                    'action' => 'buy',
                    'input' => 'silver'
                ];
            }
        }

        return [
            'action' => 'end-turn',
            'input' => null
        ];
    }

}