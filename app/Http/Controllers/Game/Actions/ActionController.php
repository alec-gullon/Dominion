<?php

namespace App\Http\Controllers\Game\Actions;

use App\Http\Controllers\Controller;

use App\Models\Game\State;

use App\Services\CardBuilder;

class ActionController extends Controller {

    protected $state;

    protected $cardBuilder;

    public function __construct(State $state, CardBuilder $cardBuilder) {
        $this->state = $state;
        $this->cardBuilder = $cardBuilder;
    }

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