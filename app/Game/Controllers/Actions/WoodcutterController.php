<?php

namespace App\Game\Controllers\Actions;

class WoodcutterController extends ActionController {

    public function play() {
        $this->addCoins(2);
        $this->addBuys(1);
        $this->resolveCard();
    }

}