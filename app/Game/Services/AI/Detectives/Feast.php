<?php

namespace App\Game\Services\AI\Detectives;

class Feast extends CardDetective {

    public function gainSelectedCard() {
        $kingdomCards = $this->state->kingdomCards();

        foreach ($kingdomCards as $stub => $amount) {
            $card = $this->cardBuilder->build($stub);
            if ($card->getValue() === 5 && $card->hasType('attack')) {
                return [
                    'action' => 'provide-input',
                    'input' => $card->stub()
                ];
            }
        }

        foreach ($kingdomCards as $stub => $amount) {
            $card = $this->cardBuilder->build($stub);
            if ($card->getValue() <= 5 && $card->hasType('attack')) {
                return [
                    'action' => 'provide-input',
                    'input' => $card->stub()
                ];
            }
        }
    }

}