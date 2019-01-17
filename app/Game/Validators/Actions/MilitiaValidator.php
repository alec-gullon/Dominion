<?php

namespace App\Game\Validators\Actions;

class MilitiaValidator extends ActionValidator {

    public function resolveMoat($input) {
        return is_bool($input);
    }

    public function resolveAttack($input) {
        $hand = $this->state->secondaryPlayer()->getHand();

        if (count($input) !== count($hand) - 3) {
            return false;
        }
        return $this->checkInputSubsetOfCardStack($input, $hand);
    }

}