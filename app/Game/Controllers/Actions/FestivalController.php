<?php

namespace App\Game\Controllers\Actions;

class FestivalController extends ActionController {

    public function play() {
        $this->state->addActions(2);
        $this->state->addCoins(2);
        $this->state->gainBuys(1);
        $this->resolveCard();
    }

}