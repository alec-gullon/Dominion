<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Gold card from the Dominion card game
 */
class Gold extends Card {

    protected $value = 6;

    protected $stub = 'gold';

    protected $name = 'Gold';

    protected $types = [
        'treasure'
    ];

    protected $denomination = 3;

}