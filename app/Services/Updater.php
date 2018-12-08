<?php

namespace App\Services;

class Updater {

    private $cartographer;

    private $state;

    public function __construct($state, $cardBuilder) {
        $this->cartographer = new Cartographer($state, $cardBuilder);
        $this->state = $state;
    }

    public function update($action, $input) {

        // if the player has just played a card, decrease actions by 1 and move card to played
        if ($action === 'play-card') {
            $this->state->deductActions(1);
            $this->state->getActivePlayer()->playCard($input);
            $this->state->togglePlayerInput(false);
            return;
        }

        if ($action === 'provide-input') {
            $controller = $this->cartographer->getNextController($action);
            $method = $this->cartographer->getNextMethod($action);
        } else {
            $controller = $this->cartographer->getController($action);
            $method = $this->cartographer->getMethod($action);
        }

        $controller->{$method}($input);
    }

    public function resolve() {
        while (!$this->state->needPlayerInput() && $this->state->getActivePlayer()->hasUnresolvedCard()) {
            $controller = $this->cartographer->getNextController();
            $method = $this->cartographer->getNextMethod();

            $controller->{$method}();
        }
    }

    public function getState() {
        return $this->state;
    }

}