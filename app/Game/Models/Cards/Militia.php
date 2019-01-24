<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Militia card from the Dominion card game
 */
class Militia extends Card {

    protected $value = 3;

    protected $stub = 'militia';

    protected $name = 'Militia';

    protected $types = [
        'action',
        'attack'
    ];

}