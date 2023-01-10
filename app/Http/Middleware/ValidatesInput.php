<?php

namespace App\Http\Middleware;

use Closure;
use Route;

class ValidatesInput {

    private $request;

    public function handle($request, Closure $next) {
        $this->request = $request;

        if (!$this->controllerExists()) {
            return $next($request);
        }

        $controllerClassName = '\App\\' . $this->controller();
        $controller = new $controllerClassName();

        if (!method_exists($controller, $this->method())) {
            return $next($request);
        }

        $validation = $controller->{$this->method()}();
        if ($validation) {
            return $next($request);
        } else {
            return redirect('/');
        }
    }

    private function controller() {
        $route = $this->request->route()->getActionName();
//        $route = explode('App\Http\Controllers\\', $route)[1];

        return 'Http\Requests\\' . explode('@', $route)[0];
    }

    private function method() {
        $route = $this->request->route()->getActionName();
        $route = explode('App\Http\Controllers\\', $route)[1];

        return explode('@', $route)[1];
    }

    private function controllerExists() {
        return file_exists(base_path() . '\app\\' . $this->controller() . '.php');
    }

}
