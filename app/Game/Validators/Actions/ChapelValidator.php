<?php

namespace App\Game\Validators\Actions;

/**
 * Validates user input in relation to certain methods on the ChapelController class
 */
class ChapelValidator extends ActionValidator {

    /**
     * Takes the provided $input and confirms that the user has those cards in their hand
     *
     * @param   mixed       $input
     *
     * @return  bool
     */
    public function trashSelectedCards($input) {
        return $this->checkStubsAreSubsetOfCardStack($input, $this->state->activePlayer()->hand);
    }

}