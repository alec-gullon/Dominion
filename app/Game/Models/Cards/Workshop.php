<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Workshop card from the Dominion card game
 */
class Workshop extends Card {

    protected $value = 3;

    protected $stub = 'workshop';

    protected $name = 'Workshop';

    protected $types = [
        'action'
    ];

}