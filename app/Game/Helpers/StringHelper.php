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
    public static function stubToCamelCase($stub) {
        $parts = explode('-', $stub);

        $alias = '';
        foreach ($parts as $part) {
            $alias .= ucfirst($part);
        }

        return $alias;
    }

    /**
     * Takes a string which represents the next step required to resolve an action card
     * and builds the corresponding method from it - e.g., 'workshop/gain-card' becomes 'gainCard'
     *
     * @param   string      $nextStep
     *
     * @return  string
     */
    public static function methodFromNextStep($nextStep) {
        $stub = explode('/', $nextStep)[1];
        return StringHelper::stubToCamelCase($stub);
    }

    /**
     * Takes a string which represents the next step required to resolve an action card and
     * returns the corresponding card alias - e.g., 'workshop/gain-card' becomes 'Workshop'
     *
     * @param   string      $nextStep
     *
     * @return  string
     */
    public static function cardAliasFromNextStep($nextStep) {
        $stub = explode('/', $nextStep)[0];
        return StringHelper::stubToCamelCase($stub);
    }

    /**
     * Creates an entry for the game log that prepends the number of ".."'s according to the
     * value of $indentation and the given $player's name. E.g.,
     *
     * "Alec played a Village" vs.
     * ".. Lucy reveals a Moat"
     *
     * @param $entry
     * @param $player
     * @param $indentation
     * @return string
     */
    public static function createPlayerActionEntry($entry, $player, $indentation) {
        $entry = $player->name . ' ' . $entry;
        if ($indentation !== 0) {
            $entry = ' ' . $entry;
        }
        for ($i = 1; $i <= $indentation; $i++) {
            $entry = '..' . $entry;
        }
        return $entry;
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
            $name = $card->name;
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

    /**
     * Filters user input which might be a string when this is not the intent and converts them to their
     * appropriate proper types
     *
     * @param   string      $input
     *
     * @return  mixed
     */
    public static function filterInput($input) {
        if ($input === 'true' || $input === 'false') {
            return ($input === 'true');
        }
        return $input;
    }

}