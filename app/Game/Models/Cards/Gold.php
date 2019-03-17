<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Gold card from the Dominion card game
 */
class Gold extends Card {

    public $value = 6;

    public $stub = 'gold';

    public $name = 'Gold';

    public $types = [
        'treasure'
    ];

    public $denomination = 3;

    public $resolved = true;

}