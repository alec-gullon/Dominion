<?php

namespace App\Game\Validators\Actions;

/**
 * Validates user input in relation to certain methods on the CellarController class
 */
class CellarValidator extends ActionValidator {

    /**
     * Confirms that the cards the user has selected to discard are actually cards in that
     * user's hand
     *
     * @param   mixed      $input
     *
     * @return  bool
     */
    public function discardSelectedCards($input) {
        return $this->checkStubsAreSubsetOfCardStack($input, $this->state->activePlayer()->hand);
    }

}