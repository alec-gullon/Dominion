<?php

namespace App\Game\Services;

use App\Game\Helpers\StringHelper;
use App\Game\Models\State;

/**
 * The Dominion Router class. Links routes to their appropriate methods on appropriate controllers.
 * The routes themselves are stored in the app.dominion config file.
 *
 * There are two methods that are used to identify a route: either via a user-selected "action" or
 * automatically determined based on the next step that is required to resolve the state
 */
class Router {

    /**
     * The game $state that needs to be injected into the Controller classes
     *
     * @var \App\Game\Models\State
     */
    private $state;

    /**
     * Array of Dominion game routes. The syntax used is based on Laravel route syntax
     *
     * @var array
     */
    private $routes;

    public function __construct() {
        $this->routes = config('dominion.routes');
    }

    public function setState(State $state) {
        $this->state = $state;
    }

    /**
     * Determines what controller should be called based on a supplied route and returns
     * an instance of this class. If the route provided is a well-defined route, then
     *
     * @param   string      $route
     *
     * @return  object
     */
    public function controller($route) {
        if (!isset($this->routes[$route])) {
            return $this->buildClassFromNextStep('Controller');
        }
        return $this->buildClassFromRoute('Controller', $route);
    }

    /**
     * Determines what validator, if any, should be called based on a supplied route and
     * returns an instance of this class, if necessary
     *
     * @return  object|null
     */
    public function validator() {
        return $this->buildClassFromNextStep('Validator');
    }

    /**
     * Determines what method should be called from a provided route and returns this method
     * as a string
     *
     * @param   string      $route
     *
     * @return  string
     */
    public function method($route) {
        if (isset($this->routes[$route])) {
            return $this->routeMethod($route);
        }
        return $this->nextMethod();
    }

    /**
     * Uses the next step on the players unresolved card to determine what the next controller
     * that should be called is
     *
     * @return  object
     */
    public function nextController() {
        $route = $this->state->activePlayer()->getNextStep();
        return $this->controller($route);
    }

    /**
     * Uses the next step on the players unresolved card to determine what the next validator
     * that should be called is. Returns null if no validation needs to occur
     *
     * @return  object|null
     */
    public function nextValidator() {
        $route = $this->state->activePlayer()->getNextStep();
        return $this->validator($route);
    }

    /**
     * Uses the next step on the players unresolved card to determine what the next method that
     * should be called is
     *
     * @return  string
     */
    public function nextMethod() {
        $step = $this->state->activePlayer()->getNextStep();
        return StringHelper::methodFromNextStep($step);
    }

    /**
     * Builds an instance of the class associated to a provided route. The $group parameter determines what
     * subfolder the Router should look in for the class and what class suffix to expect: e.g., 'Validator',
     * 'Controller'
     *
     * @param   string      $group
     * @param   string      $route
     *
     * @return  object|null
     */
    private function buildClassFromRoute($group, $route) {
        $classString = $this->routeClassAlias($route);
        $classString = 'App\Game\\' . $group . 's\\' . $classString . $group;

        if (class_exists($classString)) {
            return new $classString($this->state);
        }
        return null;
    }

    /**
     * Builds an instance of the class associated to the games current next step. The $group parameter
     * determines what subfolder the Router should look in for the class and what class suffix to expect:
     * e.g., 'Validator', 'Controller'
     *
     * @param   string      $group
     *
     * @return  null
     */
    private function buildClassFromNextStep($group) {
        $classString = $this->nextStepClassAlias();
        $classString = 'App\Game\\' . $group . 's\\' . $classString . $group;

        if (class_exists($classString)) {
            return new $classString($this->state);
        }
        return null;
    }

    /**
     * Returns the class string associated to a given route
     *
     * @param   string      $route
     *
     * @return  string
     */
    private function routeClassAlias($route) {
        $parts = explode('@', $this->routes[$route]);
        return $parts[0];
    }

    /**
     * Returns the method associated to a given route
     *
     * @param   string      $route
     *
     * @return  string
     */
    private function routeMethod($route) {
        $parts = explode('@', $this->routes[$route]);
        return $parts[1];
    }

    /**
     * Returns the class alias associated to a cards next step, e.g., bureaucrat/reveal-moat =>
     * Bureaucrat
     *
     * @return  string
     */
    private function nextStepClassAlias() {
        $step = $this->state->activePlayer()->getNextStep();
        return 'Actions\\' . StringHelper::cardAliasFromNextStep($step);
    }

}