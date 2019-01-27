<?php

namespace App\Game\Controllers\Actions;

/**
 * Controller responsible for resolving the Council Room card when it has been played
 */
class CouncilRoomController extends ActionController {

    /**
     * Adjusts game state in line with a Council Room card
     */
    public function play() {
        $this->drawCards(4);
        $this->addBuys(1);
        $this->drawCards(1, $this->secondaryPlayer());
        $this->resolveCard();
    }

}