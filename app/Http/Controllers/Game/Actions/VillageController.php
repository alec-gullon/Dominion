<?php

namespace App\Http\Controllers\Game\Actions;

class VillageController extends ActionController {

    public function play() {
        $this->state->addActions(2);
        $this->activePlayer()->drawCards(1);
        $this->resolveCard();
    }

}