<?php

namespace App\Game\Services;

use App\Models\Game\State;
use App\Services\CardBuilder;

class Router {

    private $state;

    private $cardBuilder;

    private $routes = array(
        'play-treasure' => 'HandController@playTreasure',
        'end-turn' => 'TurnController@endTurn',
        'buy' => 'BuyController@buy'
    );

    public function __construct(State $state, CardBuilder $cardBuilder) {
        $this->state = $state;
        $this->cardBuilder = $cardBuilder;
    }

    public function controller($action) {
        if (isset($this->routes[$action])) {
            return $this->getControllerFromRoutes($action);
        } else {
            return $this->getCardControllerFromAction($action);
        }
    }

    public function method($action) {
        if (isset($this->routes[$action])) {
            return $this->getMethodFromRoutes($action);
        } else {
            return $this->getCardMethodFromAction($action);
        }
    }

    public function nextController() {
        $action = $this->state->getActivePlayer()->getNextStep();
        return $this->controller($action);
    }

    public function nextMethod() {
        $action = $this->state->getActivePlayer()->getNextStep();
        return $this->method($action);
    }

    private function getMethodFromRoutes($action) {
        $route = $this->routes[$action];
        $parts = explode('@', $route);
        return $parts[1];
    }

    private function getCardMethodFromAction($action) {
        $parts = explode('/', $action);
        $methodParts = explode('-', $parts[1]);
        $methodString = '';
        foreach ($methodParts as $part) {
            $methodString .= $part;
        }
        return $methodString;
    }

    private function getCardControllerFromAction($action) {
        $parts = explode('/', $action);
        $cardParts = explode('-', $parts[0]);
        $cardString = '';
        foreach($cardParts as $part) {
            $cardString .= ucfirst($part);
        }
        $controllerString = 'App\Game\Controllers\Actions\\' . $cardString . 'Controller';
        return new $controllerString($this->state, $this->cardBuilder);
    }

    private function getControllerFromRoutes($action) {
        $route = $this->routes[$action];
        $parts = explode('@', $route);
        $controllerString = '\App\Game\Controllers\\' . $parts[0];
        return new $controllerString($this->state, $this->cardBuilder);
    }

}