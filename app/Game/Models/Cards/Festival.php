<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Festival card from the Dominion card game
 */
class Festival extends Card {

    protected $value = 5;

    protected $stub = 'festival';

    protected $name = 'Festival';

    protected $types = [
        'action'
    ];

}