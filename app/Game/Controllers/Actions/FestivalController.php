<?php

namespace App\Game\Controllers\Actions;

class FestivalController extends ActionController {

    public function play() {
        $this->addActions(2);
        $this->gainCoins(2);
        $this->addBuys(1);
        $this->resolveCard();
    }

}