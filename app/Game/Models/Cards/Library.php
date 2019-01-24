<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Library card from the Dominion card game
 */
class Library extends Card {

    protected $value = 5;

    protected $stub = 'library';

    protected $name = 'Library';

    protected $types = [
        'action'
    ];

    /**
     * Keeps track of how many cards the player has drawn up until they have
     * the choice of setting the card aside. Helps to keep the game logs clean
     *
     * @var int
     */
    public $numberOfCardsDrawn = 0;

}