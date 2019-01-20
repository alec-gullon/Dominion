<?php

namespace App\Game\Services\AI\Detectives;

class Mine extends CardDetective {

    public function trashTreasure() {
        $handCards = $this->state->activePlayer()->getHand();

        foreach ($handCards as $card) {
            if ($card->hasType('treasure') && $card->stub() !== 'gold') {
                return [
                    'action' => 'provide-input',
                    'input' => $card->stub()
                ];
            }
        }

        return [
            'action' => 'provide-input',
            'input' => 'gold'
        ];
    }

    public function gainTreasure() {
        $unresolvedCard = $this->state->activePlayer()->unresolvedCard();

        if ($unresolvedCard->treasureValue === 3) {
            $stub = 'silver';
        } else {
            $stub = 'gold';
        }

        return [
            'action' => 'provide-input',
            'input' => $stub
        ];
    }

}