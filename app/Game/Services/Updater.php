<?php

namespace App\Game\Services;

use App\Game\Models\State;
use App\Services\Factories\CardFactory;

class Updater {

    private $cartographer;

    private $state;

    private $ai;

    public function __construct(State $state) {
        $this->cartographer = new Router($state);
        $this->state = $state;
        $this->ai = resolve('\App\Game\Services\AI\AI');
        $this->ai->setState($this->state);
    }

    public function update($action, $input = null) {

        // if the player has just played a card, decrease actions by 1 and move card to played
        if ($action === 'play-card') {
            $card = CardFactory::build($input);
            $this->state->log()->addEntry($this->state->activePlayer()->getName() . ' plays ' . $card->nameWithArticlePrefix());
            $this->state->deductActions(1);
            $this->state->activePlayer()->playCard($input);
            $this->state->removePlayerInput();
            return;
        }

        if ($action === 'provide-input') {
            $controller = $this->cartographer->nextController();
            $method = $this->cartographer->nextMethod();
        } else {
            $controller = $this->cartographer->controller($action);
            $method = $this->cartographer->method($action);
        }

        $validate = $this->validate($action, $input);
        if ($validate) {
            $controller->{$method}($input);
        }
    }

    public function resolve() {
        while (!$this->state->needPlayerInput() && $this->state->activePlayer()->hasUnresolvedCard()) {
            $controller = $this->cartographer->nextController();
            $method = $this->cartographer->nextMethod();

            $controller->{$method}();
        }

        if (!$this->state->aiPlaying()) {
            return;
        }

        // let the ai make a decision about what to do, then pass that decision into the update method
        $decision = $this->ai->decision();

        $this->update($decision['action'], $decision['input']);
        $this->resolve();
    }

    public function getState() {
        return $this->state;
    }

    private function validate($action, $input) {
        $validator = null;
        $method = '';
        if ($action === 'provide-input') {
            $validator = $this->cartographer->nextValidator();
            $method = $this->cartographer->nextMethod();
        }
        if ($validator !== null) {
            if (method_exists($validator, $method)) {
                return $validator->{$method}($input);
            }
        }
        return true;
    }

}