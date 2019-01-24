<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Market card from the Dominion card game
 */
class Market extends Card {

    protected $value = 5;

    protected $stub = 'market';

    protected $name = 'Market';

    protected $types = [
        'action'
    ];

}