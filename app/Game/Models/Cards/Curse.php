<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Curse card from the Dominion card game
 */
class Curse extends Card {

    protected $value = 0;

    protected $stub = 'curse';

    protected $name = 'Curse';

    protected $types = [
        'curse'
    ];

    protected $points = -1;

}