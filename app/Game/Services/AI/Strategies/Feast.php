<?php

namespace App\Game\Services\AI\Strategies;

class Feast extends CardStrategy {

    public function gainSelectedCard() {
        $kingdomCards = $this->state->kingdomCards();

        foreach ($kingdomCards as $stub => $amount) {
            $card = $this->makeCard($stub);
            if ($card->value() === 5 && $card->hasType('attack')) {
                return $card->stub();
            }
        }

        foreach ($kingdomCards as $stub => $amount) {
            $card = $this->makeCard($stub);
            if ($card->value() <= 5 && $card->hasType('attack')) {
                return $card->stub();
            }
        }

        return 'silver';
    }

}