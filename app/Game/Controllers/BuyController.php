<?php

namespace App\Game\Controllers;

class BuyController extends StateController {

    public function buy($card) {
        $selectedCard = $this->cardBuilder->build($card);

        $this->state->deductCoins($selectedCard->getValue());
        $this->state->deductBuys(1);

        $this->state->moveCardToPlayer($card);
    }

}