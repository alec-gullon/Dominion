<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of an Adventurer card from the Dominion card game
 */
class Adventurer extends Card {

    public $value = 6;

    public $stub = 'adventurer';

    public $name = 'Adventurer';

    public $types = [
        'action'
    ];

}