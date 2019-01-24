<?php

namespace App\Game\Services\AI\Strategies;

class Workshop extends CardStrategy {

    public function gainSelectedCard() {
        // if it's a game ending situation, grab an estate, otherwise gain a random 4 cost card
        if ($this->state->checkGameOver() && $this->state->hasCard('estate')) {
            return 'estate';
        }

        $kingdomCards = $this->state->kingdomCards();
        foreach ($kingdomCards as $stub => $remaining) {
            if ($remaining === 0) {
                continue;
            }
            $card = $this->makeCard($stub);
            if ($card->value() === 4) {
                return $stub;
            }
        }

        // gain a silver as a sensible default
        return 'silver';
    }

}