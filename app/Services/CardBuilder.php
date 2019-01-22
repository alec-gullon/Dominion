<?php

namespace App\Services;

class CardBuilder {

    public function build($card) {
        $parts = explode('-', $card);
        $composed = 'App\Models\Game\Cards\\';
        foreach($parts as $part) {
            $composed .= ucfirst($part);
        }
        return new $composed();
    }

    public static function buildMultiple($stubs) {
        $cardStack = [];
        foreach ($stubs as $stub) {
            $cardStack[] = CardBuilder::buildStatic($stub);
        }
        return $cardStack;
    }

    public static function buildStatic($stub) {
        $parts = explode('-', $stub);
        $composed = 'App\Models\Game\Cards\\';
        foreach($parts as $part) {
            $composed .= ucfirst($part);
        }
        return new $composed();
    }

}