<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Woodcutter card from the Dominion card game
 */
class Woodcutter extends Card {

    public $value = 3;

    public $stub = 'woodcutter';

    public $name = 'Woodcutter';

    public $types = [
        'action'
    ];

}