<?php

namespace App\Game\Services\AI\Strategies;

class Moneylender extends CardStrategy {

    public function trashCopper() {
        return $this->state->activePlayer()->hasCard('copper');
    }

}