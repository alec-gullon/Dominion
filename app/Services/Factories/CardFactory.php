<?php

namespace App\Services\Factories;

class CardFactory {

    public static function build($stub) {
        $parts = explode('-', $stub);
        $composed = 'App\Models\Game\Cards\\';
        foreach($parts as $part) {
            $composed .= ucfirst($part);
        }
        return new $composed();
    }

    public static function buildMultiple($stubs) {
        $cardStack = [];
        foreach ($stubs as $stub) {
            $cardStack[] = CardFactory::build($stub);
        }
        return $cardStack;
    }

}