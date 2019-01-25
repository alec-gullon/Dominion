<?php

namespace App\Game\Factories;

use App\Game\Helpers\StringHelper;

/**
 * Class responsible for building instances of the models that reside in the App\Game\Models\Cards namespace
 */
class CardFactory {

    /**
     * Builds an instance of a Card model that corresponds to the provided $stub
     *
     * @param   string      $stub
     *
     * @return  object
     */
    public static function build($stub) {
        $class = 'App\Game\Models\Cards\\' . StringHelper::stubToCamelCase($stub);
        return new $class();
    }

    /**
     * Accepts an array of $stubs and builds an array of instances of card models that correspond to the
     * stubs in this array
     *
     * @param   array       $stubs
     *
     * @return  array
     */
    public static function buildMultiple($stubs) {
        $cardStack = [];
        foreach ($stubs as $stub) {
            $cardStack[] = CardFactory::build($stub);
        }
        return $cardStack;
    }

}