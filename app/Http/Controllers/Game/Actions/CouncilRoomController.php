<?php

namespace App\Http\Controllers\Game\Actions;

class CouncilRoomController extends ActionController {

    public function play() {
        $this->activePlayer()->drawCards(4);
        $this->state->gainBuys(1);
        $this->secondaryPlayer()->drawCards(1);
        $this->resolveCard();
    }

}