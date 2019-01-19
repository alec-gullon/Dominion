<?php

namespace App\Game\Services;

use App\Models\Game\State;
use App\Services\CardBuilder;

class Router {

    private $state;

    private $cardBuilder;

    public function __construct(State $state, CardBuilder $cardBuilder) {
        $this->state = $state;
        $this->cardBuilder = $cardBuilder;
    }

    public function controller($action) {
        return $this->buildClassFromAction('Controller', $action);
    }

    public function validator($action) {
        return $this->buildClassFromAction('Validator', $action);
    }

    public function method($action) {
        $routes = config('dominion.game-routes');
        if (isset($routes[$action])) {
            return $this->getMethodFromRoutes($action);
        }
        return $this->getMethodAssociatedToAction($action);
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

    private function getCardAssociatedToAction($action) {
        $parts = explode('/', $action);
        $cardParts = explode('-', $parts[0]);
        $cardString = '';
        foreach($cardParts as $part) {
            $cardString .= ucfirst($part);
        }
        return $cardString;
    }

    private function getMethodAssociatedToAction($action) {
        $parts = explode('/', $action);
        $methodParts = explode('-', $parts[1]);
        $methodString = '';
        foreach ($methodParts as $part) {
            $methodString .= ucfirst($part);
        }
        return $methodString;
    }

    private function buildClassFromAction($group, $action) {
        $routes = config('dominion.game-routes');
        if (isset($routes[$action])) {
            $classString = $this->getClassFromRoutes($action);
            $classString = 'App\Game\\' . $group . 's\\' . $classString . $group;
        } else {
            $classString = $this->getCardAssociatedToAction($action);
            $classString = 'App\Game\\' . $group . 's\Actions\\' . $classString . $group;
        }
        return new $classString($this->state, $this->cardBuilder);
    }

    private function getClassFromRoutes($action) {
        $routes = config('dominion.game-routes');
        $route = $routes[$action];
        $parts = explode('@', $route);
        return $parts[0];
    }

    private function getMethodFromRoutes($action) {
        $routes = config('dominion.game-routes');
        $route = $routes[$action];
        $parts = explode('@', $route);
        return $parts[1];
    }

}