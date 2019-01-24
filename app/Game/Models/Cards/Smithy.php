<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Smithy card from the Dominion card game
 */
class Smithy extends Card {

    protected $value = 4;

    protected $stub = 'smithy';

    protected $name = 'Smithy';

    protected $type = [
        'action'
    ];

}