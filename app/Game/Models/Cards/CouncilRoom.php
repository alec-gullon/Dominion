<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Council Room card from the Dominion card game
 */
class CouncilRoom extends Card {

    public $value = 5;

    public $stub = 'council-room';

    public $name = 'Council Room';

    public $types = [
        'action'
    ];

    public $features = [
        'terminal'
    ];

}