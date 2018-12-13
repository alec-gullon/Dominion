<?php

namespace App\Game\Controllers\Actions;

class WoodcutterController extends ActionController {

    public function play() {
        $this->state->gainBuys(1);
        $this->state->addCoins(2);
        $this->resolveCard();
    }

}