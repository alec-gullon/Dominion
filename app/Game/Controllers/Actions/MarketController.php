<?php

namespace App\Game\Controllers\Actions;

class MarketController extends ActionController {

    public function play() {
        $this->addActions(1);
        $this->addBuys(1);
        $this->addCoins(1);
        $this->drawCards(1);
        $this->resolveCard();
    }

}