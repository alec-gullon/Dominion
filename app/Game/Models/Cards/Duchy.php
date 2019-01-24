<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Duchy card from the Dominion card game
 */
class Duchy extends Card {

    protected $value = 5;

    protected $stub = 'duchy';

    protected $name = 'Duchy';

    protected $types = [
        'victory'
    ];

}