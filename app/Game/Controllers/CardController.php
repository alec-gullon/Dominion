<?php

namespace App\Game\Controllers;

use App\Game\Factories\CardFactory;

class CardController extends StateController {

    public function play($stub) {
        $card = CardFactory::build($stub);
        $this->state->log()->addEntry($this->state->activePlayer()->name() . ' plays ' . $card->nameWithArticlePrefix());
        $this->state->deductActions(1);
        $this->state->activePlayer()->playCard($stub);
        $this->state->setAwaitingPlayerInputId(null);
        return;
    }

}