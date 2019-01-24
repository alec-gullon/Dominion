<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Mine card from the Dominion card game
 */
class Mine extends Card {

    protected $value = 5;

    protected $stub = 'mine';

    protected $name = 'Mine';

    protected $types = [
        'action'
    ];

    /**
     * What value of treasure the player can gain after they have trashed a card
     * from their hand
     *
     * @var int
     */
    public $treasureValue = 0;

}