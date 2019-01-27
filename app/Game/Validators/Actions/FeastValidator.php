<?php

namespace App\Game\Validators\Actions;

/**
 * Validates user input in relation to certain methods on the FeastController class
 */
class FeastValidator extends ActionValidator {

    /**
     * Confirms that the card the user has selected to gain is actually something they should be
     * gaining - i.e., it has a value of 5 or less and there is a copy in the kingdom
     *
     * @param   mixed       $input
     *
     * @return  bool
     */
    public function gainSelectedCard($input) {
        $card = $this->makeCard($input);

        if ($card->value() > 5) {
            return false;
        }
        return $this->state->hasCard($input);
    }

}