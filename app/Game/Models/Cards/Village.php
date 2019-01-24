<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Village card from the Dominion card game
 */
class Village extends Card {

    protected $value = 3;

    protected $stub = 'village';

    protected $name = 'Village';

    protected $types = [
        'action'
    ];

    protected $features = [
        'increasesActions'
    ];

}