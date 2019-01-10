<?php

namespace App\Game\Controllers\Actions;

class WorkshopController extends ActionController {

    public function play() {
        $this->nextStep('gain-selected-card');
        $this->inputOn();
    }

    public function gainSelectedCard($stub) {
        $this->gainCard($stub);
        $this->resolveCard();
    }

}