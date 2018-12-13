<?php

namespace App\Services;

use App\Models\Game\State;

class Cartographer {

    private $state;

    private $cardBuilder;

    private $actions = array();

    private $playerInputNeeded = true;

    private $routes = array(
        'play-treasure' => '\App\Game\Controllers\HandController@playTreasure',
        'end-turn' => '\App\Game\Controllers\TurnController@endTurn',
        'buy' => '\App\Game\Controllers\BuyController@buy'
    );

    public function __construct(State $state, CardBuilder $cardBuilder) {
        $this->state = $state;
        $this->cardBuilder = $cardBuilder;
    }

    public function updateActions() {
        $actions = array();
        $activePlayer = $this->state->getActivePlayer();

        if ($activePlayer->hasTreasureCards()) {
            $actions[] = 'play-treasure';
        }

        if (0 < $this->state->getBuys()) {
            $actions[] = 'buy';
        }

        $actions[] = 'end-turn';

        $this->actions = $actions;
        $this->playerInputNeeded = true;
    }

    public function getController($action) {
        if (isset($this->routes[$action])) {
            $route = $this->routes[$action];
            $parts = explode('@', $route);
            $controllerString = $parts[0];
        } else {
            $parts = explode('/', $action);
            $cardParts = explode('-', $parts[0]);
            $cardString = '';
            foreach ($cardParts as $part) {
                $cardString .= ucfirst($part);
            }
            $controllerString = '\App\Game\Controllers\Actions\\' . $cardString . 'Controller';
        }

        $controller = new $controllerString($this->state, $this->cardBuilder);
        return $controller;
    }

    public function getMethod($action) {
        if (isset($this->routes[$action])) {
            $route = $this->routes[$action];
            $parts = explode('@', $route);
            $methodString = $parts[1];
        } else {
            $parts = explode('/', $action);
            $methodParts = explode('-', $parts[1]);
            $methodString = '';
            foreach ($methodParts as $part) {
                $methodString .= $part;
            }
        }
        return $methodString;
    }

    public function getNextController() {
        $action = $this->state->getActivePlayer()->getNextStep();
        return $this->getController($action);
    }

    public function getNextMethod() {
        $action = $this->state->getActivePlayer()->getNextStep();
        return $this->getMethod($action);
    }

    public function playerInputNeeded() {
        return $this->playerInputNeeded;
    }

}