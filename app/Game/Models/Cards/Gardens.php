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

}