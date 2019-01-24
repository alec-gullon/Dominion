<?php

namespace App\Game\Validators\Actions;

class ChapelValidator extends ActionValidator {

    public function trashSelectedCards($input) {
        $hand = $this->state->activePlayer()->hand();
        return $this->checkInputSubsetOfCardStack($input, $hand);
    }

}