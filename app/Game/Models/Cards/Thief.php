<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Thief card from the Dominion card game
 */
class Thief extends Card {

    public $value = 3;

    public $stub = 'thief';

    public $name = 'Thief';

    public $types = [
        'action',
        'attack'
    ];

    /**
     * Keeps trash of which card the player selected to trash, when it comes time to
     * choose whether or not to gain this card
     *
     * @var
     */
    public $trashedCard;

    public $features = [
        'terminal'
    ];

}