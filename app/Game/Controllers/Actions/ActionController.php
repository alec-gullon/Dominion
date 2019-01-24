<?php

namespace App\Game\Controllers\Actions;

use App\Game\Controllers\StateController;

class ActionController extends StateController {

    protected function inputOn($active = true) {
        $id = $this->activePlayer()->id();
        if (!$active) {
            $id = $this->secondaryPlayer()->id();
        }
        $this->state->setAwaitingPlayerInputId($id);
    }

    protected function inputOff() {
        $this->state->setAwaitingPlayerInputId(null);
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