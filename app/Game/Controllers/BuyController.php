<?php

namespace App\Game\Controllers;

class BuyController extends StateController {

    public function advanceToBuy() {
        $this->state->setPhase('buy');
    }

    public function buy($stub) {
        $selectedCard = $this->cardBuilder->build($stub);

        $this->state->deductCoins($selectedCard->getValue());
        $this->state->deductBuys(1);

        $this->buyCard($stub);
    }

}