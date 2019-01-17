<?php

namespace App\Game\Services;

use App\Models\Game\State;
use App\Services\CardBuilder;

class Router {

    private $state;

    private $cardBuilder;

    private $routes = array(
        'play-treasure' => 'Treasure@playTreasure',
        'end-turn' => 'Turn@endTurn',
        'buy' => 'Buy@buy',
        'advance-to-buy' => 'Buy@advanceToBuy',
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

    public function validator($action) {
        if (isset($this->routes[$action])) {
            return $this->getValidatorFromRoutes($action);
        } else {
            return $this->getValidatorFromAction($action);
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
        $action = $this->state->activePlayer()->getNextStep();
        return $this->controller($action);
    }

    public function nextValidator() {
        $action = $this->state->activePlayer()->getNextStep();
        return $this->validator($action);
    }

    public function nextMethod() {
        $action = $this->state->activePlayer()->getNextStep();
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
        $controllerString = '\App\Game\Controllers\\' . $parts[0] . 'Controller';
        return new $controllerString($this->state, $this->cardBuilder);
    }

    private function getValidatorFromRoutes($action) {
        $route = $this->routes[$action];
        $parts = explode('@', $route);
        $validatorString = '\App\Game\Validators\\' . $parts[0] . 'Validator';
        if (class_exists($validatorString)) {
            return new $validatorString($this->state, $this->cardBuilder);
        }
        return null;
    }

    private function getValidatorFromAction($action) {
        $parts = explode('/', $action);
        $cardParts = explode('-', $parts[0]);
        $cardString = '';
        foreach($cardParts as $part) {
            $cardString .= ucfirst($part);
        }
        $validatorString = 'App\Game\Validators\Actions\\' . $cardString . 'Validator';
        if (class_exists($validatorString)) {
            return new $validatorString($this->state, $this->cardBuilder);
        }
        return null;
    }

}