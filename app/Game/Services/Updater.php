<?php

namespace App\Game\Services;

class Updater {

    private $cardBuilder;

    private $cartographer;

    private $state;

    public function __construct($state, $cardBuilder) {
        $this->cardBuilder = $cardBuilder;
        $this->cartographer = new Router($state, $cardBuilder);
        $this->state = $state;
    }

    public function update($action, $input) {

        // if the player has just played a card, decrease actions by 1 and move card to played
        if ($action === 'play-card') {
            $card = $this->cardBuilder->build($input);
            $this->state->log()->addEntry($this->state->activePlayer()->getName() . ' plays ' . $card->nameWithArticlePrefix());
            $this->state->deductActions(1);
            $this->state->activePlayer()->playCard($input);
            $this->state->togglePlayerInput(false);
            return;
        }

        if ($action === 'provide-input') {
            $controller = $this->cartographer->nextController($action);
            $method = $this->cartographer->nextMethod($action);
        } else {
            $controller = $this->cartographer->controller($action);
            $method = $this->cartographer->method($action);
        }

        $controller->{$method}($input);
    }

    public function resolve() {
        while (!$this->state->needPlayerInput() && $this->state->activePlayer()->hasUnresolvedCard()) {
            $controller = $this->cartographer->nextController();
            $method = $this->cartographer->nextMethod();

            $controller->{$method}();
        }
    }

    public function getState() {
        return $this->state;
    }

}