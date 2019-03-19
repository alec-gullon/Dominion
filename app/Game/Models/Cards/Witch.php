<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Witch card from the Dominion card game
 */
class Witch extends Card {

    public $value = 5;

    public $stub = 'witch';

    public $name = 'Witch';

    public $types = [
        'action',
        'attack'
    ];

    public $features = [
        'terminal'
    ];

}