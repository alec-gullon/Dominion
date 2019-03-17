<?php

namespace App\Game\Services\AI\Strategies;

use App\Game\Models\State;

class PlayStrategy {

    private $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    public function isRequired() {
        return ($this->state->actions > 0 && $this->state->activePlayer()->hasCardsOfType('action'));
    }

    public function decision() {
        $input = $this->decideWhatActionCardToPlay();
        return [
            'action' => 'play-card',
            'input' => $input
        ];
    }

    private function decideWhatActionCardToPlay() {
        $handCards = $this->state->activePlayer()->getCardsOfType('hand', 'action');
        foreach ($handCards as $card) {
            if ($card->hasFeature('increasesActions')) {
                return $card->stub;
            }
        }

        foreach ($handCards as $card) {
            if ($card->hasType('attack')) {
                return $card->stub;
            }
        }

        return $handCards[0]->stub;
    }

}