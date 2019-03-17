<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Curse card from the Dominion card game
 */
class Curse extends Card {

    public $value = 0;

    public $stub = 'curse';

    public $name = 'Curse';

    public $types = [
        'curse'
    ];

    public $points = -1;

}