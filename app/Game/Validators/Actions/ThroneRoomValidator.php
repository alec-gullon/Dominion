<?php

namespace App\Game\Validators\Actions;

/**
 * Validates user input in relation to certain methods on the ThroneRoomController class
 */
class ThroneRoomValidator extends ActionValidator {

    /**
     * Validates that the provided $input corresponds to a card that actually exists
     * in the player's hand
     *
     * @param   mixed       $input
     * @return  bool
     */
    public function duplicateCard($input) {
        return $this->state->activePlayer()->hasCard($input);
    }

}