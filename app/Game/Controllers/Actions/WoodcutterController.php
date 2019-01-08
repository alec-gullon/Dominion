<?php

namespace App\Game\Controllers\Actions;

class WoodcutterController extends ActionController {

    public function play() {
        $this->gainCoins(2);
        $this->addBuys(1);
        $this->resolveCard();
    }

}