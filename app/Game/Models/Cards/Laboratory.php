<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Laboratory card from the Dominion card game
 */
class Laboratory extends Card {

    protected $value = 5;

    protected $stub = 'laboratory';

    protected $name = 'Laboratory';

    protected $types = [
        'action'
    ];

}