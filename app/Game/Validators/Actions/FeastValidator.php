<?php

namespace App\Game\Validators\Actions;

class FeastValidator extends ActionValidator {

    public function gainSelectedCard($input) {
        $card = $this->makeCard($input);

        if ($card->value() > 5) {
            return false;
        }
        return $this->state->hasCard($input);
    }

}