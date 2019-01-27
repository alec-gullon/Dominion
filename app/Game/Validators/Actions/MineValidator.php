<?php

namespace App\Game\Validators\Actions;

/**
 * Validates user input in relation to certain methods on the MineController class
 */
class MineValidator extends ActionValidator {

    /**
     * Has the user selected a treasure card that is in their hand?
     *
     * @param   mixed      $input
     *
     * @return  bool
     */
    public function trashTreasure($input) {
        return $this->state->activePlayer()->hasCard($input);
    }

    /**
     * Has the user selected a treasure card that exists in the kingdom and is cheaper
     * than the maximum value they can legally gain?
     *
     * @param   mixed       $input
     *
     * @return  bool
     */
    public function gainTreasure($input) {
        $mineCard = $this->state->activePlayer()->unresolvedCard();

        $card = $this->makeCard($input);
        if ($card->value() > $mineCard->treasureValue || !$card->hasType('treasure')) {
            return false;
        }
        return $this->state->hasCard($input);
    }

}