<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Thief card from the Dominion card game
 */
class Thief extends Card {

    protected $value = 3;

    protected $stub = 'thief';

    protected $name = 'Thief';

    protected $types = [
        'action',
        'attack'
    ];

}