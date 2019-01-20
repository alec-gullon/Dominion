<?php

namespace App\Game\Services\AI\Detectives;

class Remodel extends CardDetective {

    public function trashCard() {
        // start by trashing an estate, if it is possible
        $handCards = $this->state->activePlayer()->getHand();
        foreach ($handCards as $handCard) {
            if ($handCard->stub() === 'estate') {
                return [
                    'action' => 'provide-input',
                    'input' => 'estate'
                ];
            }
        }
    }

    public function gainSelectedCard() {
        // if possible, prioritise gaining a four cost attack
        $kingdomCards = $this->state->kingdomCards();
        $gainAmount = $this->state->activePlayer()->unresolvedCard()->gainValue;

        // default to gaining a silver if possible, otherwise an estate will do
        if ($gainAmount >= 3) {
            $chosenStub = 'silver';
        } else {
            $chosenStub = 'estate';
        }

        // try to gain something a bit better, if such a thing actually exists
        foreach ($kingdomCards as $stub => $amount) {
            if ($amount === 0) {
                continue;
            }
            $card = $this->cardBuilder->build($stub);
            if ($card->getValue() > $gainAmount) {
                continue;
            }

            if ($card->hasType('attack')) {
                $chosenStub = $stub;
                break;
            }
        }

        return [
            'action' => 'provide-input',
            'input' => $chosenStub
        ];
    }

}