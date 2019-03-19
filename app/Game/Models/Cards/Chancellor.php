<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Chancellor card from the Dominion card game
 */
class Chancellor extends Card {

    public $value = 3;

    public $stub = 'chancellor';

    public $name = 'Chancellor';

    public $types = [
        'action'
    ];

    public $features = [
        'terminal'
    ];

}