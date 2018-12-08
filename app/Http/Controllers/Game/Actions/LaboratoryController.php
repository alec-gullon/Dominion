<?php

namespace App\Http\Controllers\Game;

class LaboratoryController extends ActionController {

    public function play() {
        $this->state->addActions(1);
        $this->activePlayer()->drawCards(2);
        $this->resolveCard();
    }

}