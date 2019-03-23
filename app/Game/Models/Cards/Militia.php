<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Militia card from the Dominion card game
 */
class Militia extends Card {

    public $value = 4;

    public $stub = 'militia';

    public $name = 'Militia';

    public $types = [
        'action',
        'attack'
    ];

    public $features = [
        'terminal'
    ];

}