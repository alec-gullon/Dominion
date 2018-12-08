<?php

namespace App\Http\Controllers\Game;

class SmithyController extends ActionController {

    public function play() {
        $this->activePlayer()->drawCards(3);
        $this->resolveCard();
    }

}