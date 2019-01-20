<?php

namespace App\Game\Controllers\Actions;

use App\Game\Controllers\StateController;

class ActionController extends StateController {

    protected function inputOn($active = true) {
        $this->state->setAwaitingPlayerInput($active);
    }

    protected function inputOff() {
        $this->state->removePlayerInput();
    }

    protected function activePlayer() {
        return $this->state->activePlayer();
    }

    protected function secondaryPlayer() {
        return $this->state->secondaryPlayer();
    }

    protected function nextStep($step) {
        $this->activePlayer()->setNextStep($step);
    }

    protected function resolveCard() {
        $this->inputOff();
        $this->activePlayer()->resolveCard();
    }

}