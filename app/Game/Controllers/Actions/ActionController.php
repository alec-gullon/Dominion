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

    protected function addActions($amount) {
        $this->state->addActions($amount);

        if ($amount === 1) {
            $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' gains an action';
        } else {
            $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' gains ' . $amount . ' actions';
        }
        $this->state->getLog()->addEntry($entry);
    }

    protected function drawCards($amount) {
        $remainingCards = $this->activePlayer()->numberOfDrawableCards();
        $this->activePlayer()->drawCards($amount);

        if ($remainingCards === 0) {
            $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' draws nothing';
        } else if ($remainingCards === 1 || $amount === 1) {
            $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' draws a card';
        } else {
            $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' draws ' . $amount . ' cards';
        }
        $this->state->getLog()->addEntry($entry);
    }

}