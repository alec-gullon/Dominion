<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Chapel card from the Dominion card game
 */
class Chapel extends Card {

    public $value = 2;

    public $stub = 'chapel';

    public $name = 'Chapel';

    public $types = [
        'action'
    ];

    public $features = [
        'terminal'
    ];

}