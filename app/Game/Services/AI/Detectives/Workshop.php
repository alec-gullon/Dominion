<?php

namespace App\Game\Services\AI\Detectives;

use App\Models\Game\State;

class Workshop {

    private $state;

    private $cardBuilder;

    public function __construct(State $state) {
        $this->state = $state;
        $this->cardBuilder = resolve('\App\Services\CardBuilder');
    }

    public function decide() {
        // if it's a game ending situation, grab an estate, otherwise gain a random 4 cost card
        if ($this->state->checkGameOver() && $this->state->hasCard('estate')) {
            return [
                'action' => 'provide-input',
                'input' => 'estate'
            ];
        }

        $kingdomCards = $this->state->kingdomCards();
        foreach ($kingdomCards as $stub => $remaining) {
            if ($remaining === 0) {
                continue;
            }
            $card = $this->cardBuilder->build($stub);
            if ($card->getValue() === 4) {
                return [
                    'action' => 'provide-input',
                    'input' => $stub
                ];
            }
        }

        // gain a silver as a sensible default
        return [
            'action' => 'provide-input',
            'input' => 'silver'
        ];
    }

}