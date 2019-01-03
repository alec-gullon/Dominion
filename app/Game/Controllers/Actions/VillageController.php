<?php

namespace App\Game\Controllers\Actions;

class VillageController extends ActionController {

    public function play() {
        $this->addActions(2);
        $this->drawCards(1);
        $this->resolveCard();
    }

}