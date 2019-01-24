<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Chancellor card from the Dominion card game
 */
class Chancellor extends Card {

    protected $value = 3;

    protected $stub = 'chancellor';

    protected $name = 'Chancellor';

    protected $types = [
        'action'
    ];

}