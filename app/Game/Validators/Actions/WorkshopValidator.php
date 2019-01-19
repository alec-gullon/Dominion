<?php

namespace App\Game\Validators\Actions;

class WorkshopValidator extends ActionValidator {

    public function gainSelectedCard($input) {
        $card = $this->cardBuilder->build($input);

        if ($card->getValue() > 4) {
            return false;
        }
        return $this->state->hasCard($input);
    }

}