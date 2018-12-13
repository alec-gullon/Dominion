<?php

namespace App\Game\Controllers\Actions;

use App\Game\Controllers\StateController;

class ActionController extends StateController {

    protected function inputOn() {
        $this->state->togglePlayerInput(true);
    }

    protected function inputOff() {
        $this->state->togglePlayerInput(false);
    }

    protected function activePlayer() {
        return $this->state->getActivePlayer();
    }

    protected function secondaryPlayer() {
        return $this->state->getSecondaryPlayer();
    }

    protected function nextStep($step) {
        $this->activePlayer()->setNextStep($step);
    }

    protected function resolveCard() {
        $this->inputOff();
        $this->activePlayer()->resolveCard();
    }

}