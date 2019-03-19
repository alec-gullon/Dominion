<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Festival card from the Dominion card game
 */
class Festival extends Card {

    public $value = 5;

    public $stub = 'festival';

    public $name = 'Festival';

    public $types = [
        'action'
    ];

    public $features = [
        'increasesActions'
    ];

}