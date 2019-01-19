<?php

namespace App\Game\Validators\Actions;

class ThiefValidator extends ActionValidator {

    public function resolveMoat($input) {
        return is_bool($input);
    }

    public function resolveAttack($input) {
        $card = $this->cardBuilder->build($input);
        if (!$card->hasType('treasure')) {
            return false;
        }
        return $this->state->secondaryPlayer()->hasCard($input, 'revealed');
    }

    public function gainTrashedCard($input) {
        return is_bool($input);
    }

}