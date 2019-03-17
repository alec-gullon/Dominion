<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Moneylender card from the Dominion card game
 */
class Remodel extends Card {

    public $value = 4;

    public $stub = 'remodel';

    public $name = 'Remodel';

    public $types = [
        'action'
    ];

    /**
     * What value of card the player may gain after they have trashed a card from their hand
     *
     * @var int
     */
    public $gainValue = 0;

}