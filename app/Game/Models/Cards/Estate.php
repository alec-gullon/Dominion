<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of an Estate card from the Dominion card game
 */
class Estate extends Card {

    public $value = 2;

    public $stub = 'estate';

    public $name = 'Estate';

    public $types = [
        'victory'
    ];

}