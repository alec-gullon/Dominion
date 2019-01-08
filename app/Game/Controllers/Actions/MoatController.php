<?php

namespace App\Game\Controllers\Actions;

class MoatController extends ActionController {

    public function play() {
        $this->drawCards(2);
        $this->resolveCard();
    }

}