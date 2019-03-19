<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Throne Room card from the Dominion card game
 */
class ThroneRoom extends Card {

    public $value = 3;

    public $stub = 'throne-room';

    public $name = 'Throne Room';

    public $types = [
        'action'
    ];

    public $features = [
        'terminal'
    ];

}