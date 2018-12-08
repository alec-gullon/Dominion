<?php

namespace App\Http\Controllers\Game;

class MarketController extends ActionController {

    public function play() {
        $this->state->addActions(1);
        $this->state->gainBuys(1);
        $this->state->addCoins(1);
        $this->activePlayer()->drawCards(1);
        $this->resolveCard();
    }

}