<?php

namespace App\Game\Services;

use App\Game\Models\State;
use App\Game\Factories\CardFactory;

class Router {

    private $state;

    public function setState($state) {
        $this->state = $state;
    }

    public function controller($action) {
        if ($action === 'provide-input') {
            $action = $this->state->activePlayer()->getNextStep();
        }
        return $this->buildClassFromAction('Controller', $action);
    }

    public function validator($action) {
        return $this->buildClassFromAction('Validator', $action);
    }

    public function method($action) {
        if ($action === 'provide-input') {
            $action = $this->state->activePlayer()->getNextStep();
        }

        $routes = config('dominion.routes');
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
        $routes = config('dominion.routes');
        if (isset($routes[$action])) {
            $classString = $this->getClassFromRoutes($action);
            $classString = 'App\Game\\' . $group . 's\\' . $classString . $group;
        } else {
            $classString = $this->getCardAssociatedToAction($action);
            $classString = 'App\Game\\' . $group . 's\Actions\\' . $classString . $group;
        }
        if (class_exists($classString)) {
            return new $classString($this->state);
        }
        return null;
    }

    private function getClassFromRoutes($action) {
        $routes = config('dominion.routes');
        $route = $routes[$action];
        $parts = explode('@', $route);
        return $parts[0];
    }

    private function getMethodFromRoutes($action) {
        $routes = config('dominion.routes');
        $route = $routes[$action];
        $parts = explode('@', $route);
        return $parts[1];
    }

}