<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Province card from the Dominion card game
 */
class Province extends Card {

    public $value = 8;

    public $stub = 'province';

    public $name = 'Province';

    public $types = [
        'victory'
    ];

}