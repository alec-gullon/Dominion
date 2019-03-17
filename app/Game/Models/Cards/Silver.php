<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Silver card from the Dominion card game
 */
class Silver extends Card {

    public $value = 3;

    public $stub = 'silver';

    public $name = 'Silver';

    public $types = [
        'treasure'
    ];

    public $denomination = 2;

    public $resolved = true;

}