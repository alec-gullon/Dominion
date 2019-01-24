<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Chapel card from the Dominion card game
 */
class Chapel extends Card {

    protected $value = 2;

    protected $stub = 'chapel';

    protected $name = 'Chapel';

    protected $types = [
        'action'
    ];

}