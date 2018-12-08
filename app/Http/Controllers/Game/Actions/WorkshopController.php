<?php

namespace App\Http\Controllers\Game;

class WorkshopController extends ActionController {

    public function play() {
        $this->nextStep('gain-card');
        $this->inputOn();
    }

    public function gainCard($stub) {
        $this->state->moveCardToPlayer($stub);
        $this->resolveCard();
    }

}