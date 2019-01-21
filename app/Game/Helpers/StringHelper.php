<?php

namespace App\Game\Helpers;

class StringHelper {

    public static function cardAliasFromStub($stub) {
        $parts = explode('-', $stub);

        $alias = '';
        foreach ($parts as $part) {
            $alias .= ucfirst($part);
        }

        return $alias;
    }

    public static function methodFromCardAction($action) {
        $action = explode('/', $action)[1];
        $parts = explode('-', $action);

        $method = '';
        foreach ($parts as $part) {
            $method .= ucfirst($part);
        }

        return lcfirst($method);
    }

}