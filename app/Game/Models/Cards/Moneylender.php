<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Moneylender card from the Dominion card game
 */
class Moneylender extends Card {

    public $value = 3;

    public $stub = 'moneylender';

    public $name = 'Moneylender';

    public $types = [
        'action'
    ];

}