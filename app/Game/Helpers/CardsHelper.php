<?php

namespace App\Game\Helpers;

/**
 * Helper class that provides some methods related to manipulating sets of Card models
 */
class CardsHelper {

    /**
     * Takes an array of Card models and sorts these according to their names
     *
     * @param   array       $cardStack
     *
     * @return  array
     */
    public static function sortCardStackByName($cardStack) {
        usort($cardStack, function($a, $b) {
            if ($a->name() < $b->name()) {
                return -1;
            }
            return 1;
        });
        return $cardStack;
    }

}