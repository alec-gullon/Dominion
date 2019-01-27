<?php

namespace App\Game\Validators\Actions;

/**
 * Validates user input in relation to certain methods on the BureaucratController class
 */
class BureaucratValidator extends ActionValidator {

    /**
     * Takes the users input and confirms this represents a card they have in their hand
     *
     * @param   mixed      $input
     *
     * @return  bool
     */
    public function resolveAttack($input) {
        return $this->state->secondaryPlayer()->hasCard($input);
    }

}