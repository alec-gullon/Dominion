<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Feast card from the Dominion card game
 */
class Feast extends Card {

    protected $value = 4;

    protected $stub = 'feast';

    protected $name = 'Feast';

    protected $types = [
        'action'
    ];

}