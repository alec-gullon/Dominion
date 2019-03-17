<?php

namespace App\Game\Validators\Actions;

/**
 * Validates user input in relation to certain methods on the RemodelController class
 */
class RemodelValidator extends ActionValidator {

    /**
     * Checks if the user has selected a card that actually resides in their hand
     *
     * @param   mixed       $input
     *
     * @return  bool
     */
    public function trashCard($input) {
        return $this->state->activePlayer()->hasCard($input);
    }

    /**
     * Has the user selected a card that exists in the kingdom and is cheaper
     * than the maximum value they can legally gain?
     *
     * @param   mixed       $input
     *
     * @return  bool
     */
    public function gainSelectedCard($input) {
        $remodelCard = $this->state->activePlayer()->unresolvedCard();

        $card = $this->makeCard($input);
        if ($card->value > $remodelCard->gainValue) {
            return false;
        }
        return $this->state->hasCard($input);
    }

}