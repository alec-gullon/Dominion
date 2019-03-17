<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Cellar card from the Dominion card game
 */
class Cellar extends Card {

    public $value = 2;

    public $stub = 'cellar';

    public $name = 'Cellar';

    public $types = [
        'action'
    ];

}