<?php

namespace App\Game\Validators\Actions;

/**
 * Validates user input in relation to certain methods on the MilitiaController class
 */
class MilitiaValidator extends ActionValidator {

    /**
     * Confirms that the user has selected the correct number of cards and has actually
     * selected cards that are within their hand
     *
     * @param   mixed       $input
     *
     * @return  bool
     */
    public function resolveAttack($input) {
        $hand = $this->state->secondaryPlayer()->hand;

        if (count($input) !== count($hand) - 3) {
            return false;
        }
        return $this->checkStubsAreSubsetOfCardStack($input, $hand);
    }

}