<?php

namespace App\Game\Validators\Actions;

class RemodelValidator extends ActionValidator {

    public function trashCard($input) {
        return $this->state->activePlayer()->hasCard($input);
    }

    public function gainSelectedCard($input) {
        $remodelCard = $this->state->activePlayer()->unresolvedCard();

        $card = $this->makeCard($input);
        if ($card->value() > $remodelCard->gainValue) {
            return false;
        }
        return $this->state->hasCard($input);
    }

}