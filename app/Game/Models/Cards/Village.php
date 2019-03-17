<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Village card from the Dominion card game
 */
class Village extends Card {

    public $value = 3;

    public $stub = 'village';

    public $name = 'Village';

    public $types = [
        'action'
    ];

    public $features = [
        'increasesActions'
    ];

}