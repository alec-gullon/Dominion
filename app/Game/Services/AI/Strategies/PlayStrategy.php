<?php

namespace App\Game\Services\AI\Strategies;

use App\Game\Models\State;

class PlayStrategy {

    private $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    public function isRequired() {
        return ($this->state->phase === 'action');
    }

    public function decision() {
        $input = $this->decideWhatActionCardToPlay();

        $action = 'play-card';
        if ($input === null) {
            $action = 'advance-to-buy';
        }

        return [
            'action' => $action,
            'input' => $input
        ];
    }

    private function decideWhatActionCardToPlay() {
        $handCards = $this->state->activePlayer()->getCardsOfType('hand', 'action');

        if (count($handCards) === 0 || $this->state->actions === 0) {
            return null;
        }

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