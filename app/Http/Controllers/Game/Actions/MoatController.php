<?php

namespace App\Http\Controllers\Game\Actions;

class MoatController extends ActionController {

    public function play() {
        $this->activePlayer()->drawCards(2);
        $this->resolveCard();
    }

}