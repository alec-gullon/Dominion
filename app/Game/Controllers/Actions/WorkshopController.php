<?php

namespace App\Game\Controllers\Actions;

class WorkshopController extends ActionController {

    public function play() {
        $this->nextStep('gain-card');
        $this->inputOn();
    }

    public function gainCard($stub) {
        $this->state->moveCardToPlayer($stub);
        $this->gainCardDescription($stub, $this->activePlayer());
        $this->resolveCard();
    }

}