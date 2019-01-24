<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Moat card from the Dominion card game
 */
class Moat extends Card {

    protected $value = 2;

    protected $stub = 'moat';

    protected $name = 'Moat';

    protected $type = [
        'action'
    ];

}