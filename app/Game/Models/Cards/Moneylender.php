<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Moneylender card from the Dominion card game
 */
class Moneylender extends Card {

    protected $value = 3;

    protected $stub = 'moneylender';

    protected $name = 'Moneylender';

    protected $types = [
        'action'
    ];

}