<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Copper card from the Dominion card game
 */
class Copper extends Card {

    public $value = 0;

    public $stub = 'copper';

    public $name = 'Copper';

    public $types = [
        'treasure'
    ];

    public $denomination = 1;

    public $resolved = true;

}