<?php

namespace App\Game\Controllers;

class BuyController extends StateController {

    public function advanceToBuy() {
        $this->state->setPhase('buy');
    }

    public function buy($stub) {
        $selectedCard = $this->buildCard($stub);

        $this->state->deductCoins($selectedCard->value());
        $this->state->deductBuys(1);

        $this->buyCard($stub);
    }

}