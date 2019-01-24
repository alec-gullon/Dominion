<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Gardens card from the Dominion card game
 */
class Gardens extends Card {

    protected $value = 4;

    protected $stub = 'gardens';

    protected $name = 'Gardens';

    protected $types = [
        'victory'
    ];

}