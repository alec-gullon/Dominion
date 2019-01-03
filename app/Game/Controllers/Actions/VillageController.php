<?php

namespace App\Game\Controllers\Actions;

class VillageController extends ActionController {

    public function play() {
        $this->state->addActions(2);
        $this->activePlayer()->drawCards(1);
        $this->resolveCard();

        $this->state->getLog()->addEntry($this->state->getActivePlayer()->getName() . ' plays a village');
        $this->state->getLog()->addEntry('.. ' . $this->state->getActivePlayer()->getName() . ' draws a card');
        $this->state->getLog()->addEntry('.. ' . $this->state->getActivePlayer()->getName() . ' gains two actions');
    }

}