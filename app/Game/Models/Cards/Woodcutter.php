<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Woodcutter card from the Dominion card game
 */
class Woodcutter extends Card {

    protected $value = 3;

    protected $stub = 'woodcutter';

    protected $name = 'Woodcutter';

    protected $types = [
        'action'
    ];

}