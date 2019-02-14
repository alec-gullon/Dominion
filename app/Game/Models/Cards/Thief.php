<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Thief card from the Dominion card game
 */
class Thief extends Card {

    protected $value = 3;

    protected $stub = 'thief';

    protected $name = 'Thief';

    protected $types = [
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

}