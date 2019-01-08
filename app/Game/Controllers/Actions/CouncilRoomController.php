<?php

namespace App\Game\Controllers\Actions;

class CouncilRoomController extends ActionController {

    public function play() {
        $this->drawCards(4);
        $this->addBuys(1);
        $this->drawCards(1, $this->state->getSecondaryPlayerKey());
        $this->resolveCard();
    }

}