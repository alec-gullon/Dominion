<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Throne Room card from the Dominion card game
 */
class ThroneRoom extends Card {

    protected $value = 3;

    protected $stub = 'throne-room';

    protected $name = 'Throne Room';

    protected $types = [
        'action'
    ];

}