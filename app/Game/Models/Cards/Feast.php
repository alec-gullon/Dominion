<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Feast card from the Dominion card game
 */
class Feast extends Card {

    public $value = 4;

    public $stub = 'feast';

    public $name = 'Feast';

    public $types = [
        'action'
    ];

}