<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Market card from the Dominion card game
 */
class Market extends Card {

    public $value = 5;

    public $stub = 'market';

    public $name = 'Market';

    public $types = [
        'action'
    ];

}