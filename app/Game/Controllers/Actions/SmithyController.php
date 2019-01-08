<?php

namespace App\Game\Controllers\Actions;

class SmithyController extends ActionController {

    public function play() {
        $this->drawCards(3);
        $this->resolveCard();
    }

}