<?php

namespace App\Game\Controllers\Actions;

/**
 * Controller responsible for resolving the Market card when it has been played
 */
class MarketController extends ActionController {

    /**
     * Adjusts game state in line with a Market card
     */
    public function play() {
        $this->addActions(1);
        $this->addBuys(1);
        $this->addCoins(1);
        $this->drawCards(1);
        $this->resolveCard();
    }

}