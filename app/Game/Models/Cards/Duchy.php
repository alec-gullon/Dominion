<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Duchy card from the Dominion card game
 */
class Duchy extends Card {

    public $value = 5;

    public $stub = 'duchy';

    public $name = 'Duchy';

    public $types = [
        'victory'
    ];

}