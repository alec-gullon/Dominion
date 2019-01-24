<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Province card from the Dominion card game
 */
class Province extends Card {

    protected $value = 8;

    protected $stub = 'province';

    protected $name = 'Province';

    protected $types = [
        'victory'
    ];

}