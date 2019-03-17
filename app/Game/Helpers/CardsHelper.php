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
            if ($a->name < $b->name) {
                return -1;
            }
            return 1;
        });
        return $cardStack;
    }

    /**
     * Takes a set of $stubs and confirms that this stub is "contained" in an array of instances of
     * card Models from \App\Game\Models\Cards. This comparison takes into account the number of each
     * individual stub, e.g., [estate, estate] is not a subset of any stack containing one instance
     * of the Estate model
     *
     * @param   array       $stubs
     * @param   array       $cardStack
     *
     * @return  bool
     */
    public static function checkStubsAreSubsetOfCardStack($stubs, $cardStack) {
        $originalCount = count($cardStack);

        foreach ($stubs as $stub) {
            foreach ($cardStack as $key => $card) {
                if ($card->stub === $stub) {
                    unset($cardStack[$key]);
                    break;
                }
            }
        }

        return (count($cardStack) === $originalCount - count($stubs));
    }

}