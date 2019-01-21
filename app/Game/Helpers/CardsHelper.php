<?php

namespace App\Game\Helpers;

class CardsHelper {

    public static function sortCardStackByName($cardStack) {
        usort($cardStack, function($a, $b) {
            if ($a->getName() < $b->getName()) {
                return -1;
            }
            return 1;
        });
        return $cardStack;
    }

}