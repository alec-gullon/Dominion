<?php

namespace App\Game\Helpers;

/**
 * Helper class that provides some methods related to the manipulation and creation
 * of certain types of strings
 */
class StringHelper {

    /**
     * Builds a cards class alias from its stub - e.g., 'council-room' becomes 'CouncilRoom'. This alias
     * is then used in class names related to this card - e.g., CouncilRoomController
     *
     * @param   string      $stub
     *
     * @return  string
     */
    public static function cardAliasFromStub($stub) {
        $parts = explode('-', $stub);

        $alias = '';
        foreach ($parts as $part) {
            $alias .= ucfirst($part);
        }

        return $alias;
    }

    /**
     * Takes a string which represents some kind of in game $action corresponding to an action card
     * and builds the corresponding method from it - e.g., 'workshop/gain-card' becomes 'gainCard'
     *
     * @param   string      $action
     *
     * @return  string
     */
    public static function methodFromCardAction($action) {
        $action = explode('/', $action)[1];
        $parts = explode('-', $action);

        $method = '';
        foreach ($parts as $part) {
            $method .= ucfirst($part);
        }

        return lcfirst($method);
    }

    /**
     * Describes the given array of cards in a log friendly format - e.g., ['estate', 'estate', 'village']
     * becomes 'two Estates and a Village'. The alphabetical order of the elements is determined by
     * the first appearance of each element in the $cardStack array
     *
     * @param   array       $cardStack
     *
     * @return  string
     */
    public static function describeCardStack($cardStack) {
        $cardAmounts = [];
        foreach ($cardStack as $card) {
            $name = $card->name();
            if (!isset($cardAmounts[$name])) {
                $cardAmounts[$name] = [
                    'amount' => 0,
                    'card' => $card
                ];
            }
            $cardAmounts[$name]['amount']++;
        }

        $descriptor = '';

        $i = 1;
        foreach ($cardAmounts as $name => $details) {
            $amount = $details['amount'];
            $card = $details['card'];
            if ($amount === 1) {
                $descriptor .= ' ' . $card->nameWithArticlePrefix();
            } else {
                $descriptor  .= ' ' . config('dominion.number-mappings')[$amount] . ' ' . $card->pluralFormOfName();
            }

            if ($i === count($cardAmounts) - 1) {
                $descriptor .= ' and';
            } else if ($i < count($cardAmounts) - 1) {
                $descriptor .= ',';
            }

            $i++;
        }
        return $descriptor;
    }

}