<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Workshop card from the Dominion card game
 */
class Workshop extends Card {

    public $value = 3;

    public $stub = 'workshop';

    public $name = 'Workshop';

    public $types = [
        'action'
    ];

    public $features = [
        'terminal'
    ];

}