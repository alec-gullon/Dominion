<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Council Room card from the Dominion card game
 */
class CouncilRoom extends Card {

    protected $value = 5;

    protected $stub = 'council-room';

    protected $name = 'Council Room';

    protected $types = [
        'action'
    ];

}