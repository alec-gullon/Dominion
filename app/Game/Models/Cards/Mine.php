<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Mine card from the Dominion card game
 */
class Mine extends Card {

    public $value = 5;

    public $stub = 'mine';

    public $name = 'Mine';

    public $types = [
        'action'
    ];

    public $features = [
        'terminal'
    ];

    /**
     * What value of treasure the player can gain after they have trashed a card
     * from their hand
     *
     * @var int
     */
    public $treasureValue = 0;

}