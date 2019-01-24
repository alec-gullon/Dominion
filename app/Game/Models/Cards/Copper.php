<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Copper card from the Dominion card game
 */
class Copper extends Card {

    protected $value = 0;

    protected $stub = 'copper';

    protected $name = 'Copper';

    protected $types = [
        'treasure'
    ];

    protected $denomination = 1;

}