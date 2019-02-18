<?php

namespace App\Game\Services;

use App\Game\Services\AI\AI;
use App\Game\Services\Router;

/**
 * The class responsible for updating the game state. The major methods the class updates are an update method,
 * which coordinates updating the game state in response to some player/ai supplied input and a resolve method,
 * which coordinates resolving everything that needs to happen once player supplied input has been accepted and
 * dealt with
 */
class Updater {

    /**
     * The router used to decide what controller needs to be called next when resolving
     * an update or resolve method
     *
     * @var \App\Game\Services\Router
     */
    private $router;

    /**
     * The actual state that this updater is responsible for updating
     *
     * @var \App\Game\Models\State
     */
    private $state;

    /**
     * The artificial intelligence that can be used to provide player input in the
     * absence of an actual physical player
     *
     * @var \App\Game\Services\AI\AI
     */
    private $ai;

    public function __construct(Router $router, AI $ai) {
        $this->router = $router;
        $this->ai = $ai;
    }

    public function state() {
        return $this->state;
    }

    /**
     * Sets the state that the Updater is concerned with and passes this down to the classes
     * dependencies as well
     *
     * @param   \App\Game\Models\State      $state
     */
    public function setState($state) {
        $this->state = $state;
        $this->router->setState($state);
        $this->ai->setState($state);
    }

    /**
     * Calls the appropriate method on the appropriate controller in response to the action
     * selected by the player/ai. Also validates the provided input if necessary
     *
     * @param   string          $action
     * @param   string|null     $input
     */
    public function update($action, $input = null) {
        $controller = $this->router->controller($action);
        $method = $this->router->method($action);

        $validate = $this->validate($action, $input);
        if ($validate) {
            $controller->{$method}($input);
        }
    }

    /**
     * Resolves any remaining updates that need to be carried out in the game, until player input
     * is required to proceed. If this input is required from an ai, then fetches this input and
     * invokes a new update/resolve cycle
     */
    public function resolve() {
        $state = $this->state;

        while (!$state->needPlayerInput() && $state->activePlayer()->hasUnresolvedCard()) {
            $controller = $this->router->nextController();
            $method = $this->router->nextMethod();
            $controller->{$method}();
        }

        if ($state->aiPlaying()) {
            $decision = $this->ai->decision();
            $this->update($decision['action'], $decision['input']);
            $this->resolve();
        }
    }

    /**
     * Calls the validator corresponding to the chosen action and ensures that the chosen input
     * makes sense in the context of the current state of the game
     *
     * @param   string          $action
     * @param   string|null     $input
     *
     * @return  bool
     */
    private function validate($action, $input) {
        if ($action !== 'provide-input') {
            $validator = $this->router->validator($action);
            $method = $this->router->method($action);
        } else {
            $validator = $this->router->nextValidator();
            $method = $this->router->nextMethod();
        }



        if ($validator !== null && method_exists($validator, $method)) {
            return $validator->{$method}($input);
        }
        return true;
    }

}