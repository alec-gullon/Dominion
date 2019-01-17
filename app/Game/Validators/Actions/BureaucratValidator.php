<?php

namespace App\Game\Validators\Actions;

class BureaucratValidator extends ActionValidator {

    public function resolveMoat($input){
        return is_bool($input);
    }

    public function resolveAttack($input) {
        return $this->state->secondaryPlayer()->hasCard($input);
    }

}