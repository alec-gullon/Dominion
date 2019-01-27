<?php

namespace App\Game\Validators\Actions;

/**
 * Validates user input in relation to certain methods on the WorkshopController class
 */
class WorkshopValidator extends ActionValidator {

    /**
     * Validates that the provided $input corresponds to a card that exists within the kingdom
     * and costs less than 4
     *
     * @param   mixed       $input
     *
     * @return  bool
     */
    public function gainSelectedCard($input) {
        $card = $this->makeCard($input);

        if ($card->value() > 4) {
            return false;
        }
        return $this->state->hasCard($input);
    }

}