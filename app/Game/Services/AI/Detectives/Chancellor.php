<?php

namespace App\Game\Services\AI\Detectives;

class Chancellor extends CardDetective {

    public function putDeckInDiscard() {
        return [
            'action' => 'provide-input',
            'input' => true
        ];
    }

}