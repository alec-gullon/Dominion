<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Laboratory card from the Dominion card game
 */
class Laboratory extends Card {

    public $value = 5;

    public $stub = 'laboratory';

    public $name = 'Laboratory';

    public $types = [
        'action'
    ];

}