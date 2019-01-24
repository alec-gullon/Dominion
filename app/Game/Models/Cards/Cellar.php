<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Cellar card from the Dominion card game
 */
class Cellar extends Card {

    protected $value = 2;

    protected $stub = 'cellar';

    protected $name = 'Cellar';

    protected $types = [
        'action'
    ];

}