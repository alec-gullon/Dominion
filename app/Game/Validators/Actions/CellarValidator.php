<?php

namespace App\Game\Validators\Actions;

class CellarValidator extends ActionValidator {

    public function discardSelectedCards($input) {
        return $this->checkInputSubsetOfCardStack($input, $this->state->activePlayer()->hand());
    }

}