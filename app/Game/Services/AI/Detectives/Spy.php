<?php

namespace App\Game\Services\AI\Detectives;

class Spy extends CardDetective {

    public function resolveMoat() {
        return [
            'action' => 'provide-input',
            'input' => true
        ];
    }

    public function discardCard() {
        $card = $this->state->activePlayer()->revealed()[0];

        $shouldDiscard = false;
        if (    $card->hasType('victory')
            ||  $card->getValue() <= 2
        ) {
            $shouldDiscard = true;
        }

        return [
            'action' => 'provide-input',
            'input' => $shouldDiscard
        ];
    }

    public function discardOpponentCard() {
        $card = $this->state->secondaryPlayer()->revealed()[0];

        $shouldDiscard = true;
        if (    $card->hasType('victory')
            ||  $card->getValue() <= 2
        ) {
            $shouldDiscard = false;
        }

        return [
            'action' => 'provide-input',
            'input' => $shouldDiscard
        ];
    }

}