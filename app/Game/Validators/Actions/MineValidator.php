<?php

namespace App\Game\Validators\Actions;

class MineValidator extends ActionValidator {

    public function trashTreasure($input) {
        return $this->state->activePlayer()->hasCard($input);
    }

    public function gainTreasure($input) {
        $mineCard = $this->state->activePlayer()->unresolvedCard();

        $card = $this->makeCard($input);
        if ($card->getValue() > $mineCard->treasureValue) {
            return false;
        }
        if (!$card->hasType('treasure')) {
            return false;
        }
        return $this->state->hasCard($input);
    }

}