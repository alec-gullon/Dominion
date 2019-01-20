<?php

namespace App\Game\Services;

use App\Models\Game\State;
use App\Services\CardBuilder;

class Updater {

    private $cardBuilder;

    private $cartographer;

    private $state;

    private $detective;

    public function __construct(State $state, CardBuilder $cardBuilder) {
        $this->cardBuilder = $cardBuilder;
        $this->cartographer = new Router($state, $cardBuilder);
        $this->state = $state;
        $this->detective = resolve('\App\Game\Services\AI\Detective');
        $this->detective->setState($this->state);
    }

    public function update($action, $input = null) {

        // if the player has just played a card, decrease actions by 1 and move card to played
        if ($action === 'play-card') {
            $card = $this->cardBuilder->build($input);
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
        $decision = $this->detective->decision();

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