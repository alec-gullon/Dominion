<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Moat card from the Dominion card game
 */
class Moat extends Card {

    public $value = 2;

    public $stub = 'moat';

    public $name = 'Moat';

    public $types = [
        'action'
    ];

}