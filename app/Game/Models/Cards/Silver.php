<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Silver card from the Dominion card game
 */
class Silver extends Card {

    protected $value = 3;

    protected $stub = 'silver';

    protected $name = 'Silver';

    protected $types = [
        'treasure'
    ];

    protected $denomination = 2;

    protected $resolved = true;

}