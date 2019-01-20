<?php

namespace App\Game\Services\AI\Detectives;

class Witch extends CardDetective {

    public function resolveMoat() {
        return [
            'action' => 'provide-input',
            'input' => true
        ];
    }

}