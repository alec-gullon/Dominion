<?php

namespace App\Game\Services\AI\Detectives;

class Moneylender extends CardDetective {

    public function trashCopper() {
        return [
            'action' => 'provide-input',
            'input' => $this->state->activePlayer()->hasCard('copper')
        ];
    }

}