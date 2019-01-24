<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Witch card from the Dominion card game
 */
class Witch extends Card {

    protected $value = 3;

    protected $stub = 'witch';

    protected $name = 'Witch';

    protected $types = [
        'action',
        'attack'
    ];

}