<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of an Estate card from the Dominion card game
 */
class Estate extends Card {

    protected $value = 2;

    protected $stub = 'estate';

    protected $name = 'Estate';

    protected $types = [
        'victory'
    ];

}