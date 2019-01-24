<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of an Adventurer card from the Dominion card game
 */
class Adventurer extends Card {

    protected $value = 6;

    protected $stub = 'adventurer';

    protected $name = 'Adventurer';

    protected $types = [
        'action'
    ];

}