<?php

namespace App\Game\Validators\Actions;

class FeastValidator extends ActionValidator {

    public function gainSelectedCard($input) {
        $card = $this->makeCard($input);

        if ($card->getValue() > 5) {
            return false;
        }
        return $this->state->hasCard($input);
    }

}