<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Gardens card from the Dominion card game
 */
class Gardens extends Card {

    public $value = 4;

    public $stub = 'gardens';

    public $name = 'Gardens';

    public $types = [
        'victory'
    ];

    /**
     * One point for every 10 cards in a player's deck at the end of the game
     *
     * @param   int         $deckSize
     * @return  int
     */
    public function points($deckSize) {
        return floor($deckSize/10);
    }

}