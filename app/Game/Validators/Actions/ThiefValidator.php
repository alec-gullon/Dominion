<?php

namespace App\Game\Validators\Actions;

/**
 * Validates user input in relation to certain methods on the ThiefController class
 */
class ThiefValidator extends ActionValidator {

    /**
     * Validates if the user has selected a treasure card that has been revealed by
     * the previous card effects
     *
     * @param   mixed       $input
     *
     * @return bool
     */
    public function resolveAttack($input) {
        $card = $this->makeCard($input);
        if (!$card->hasType('treasure')) {
            return false;
        }
        return $this->state->secondaryPlayer()->hasCard($input, 'revealed');
    }

}