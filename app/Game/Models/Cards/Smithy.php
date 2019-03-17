<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Smithy card from the Dominion card game
 */
class Smithy extends Card {

    public $value = 4;

    public $stub = 'smithy';

    public $name = 'Smithy';

    public $types = [
        'action'
    ];

}