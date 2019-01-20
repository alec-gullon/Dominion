<?php

namespace App\Game\Services\AI\Detectives;

class Workshop extends CardDetective {

    public function gainSelectedCard() {
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