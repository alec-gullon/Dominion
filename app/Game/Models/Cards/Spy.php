<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Spy card from the Dominion card game
 */
class Spy extends Card {

    public $value = 3;

    public $stub = 'spy';

    public $name = 'Spy';

    public $types = [
        'action',
        'attack'
    ];

    /**
     * Whether or not the opposing player has revealed a moat. Necessary because the
     * player who has played a card needs to resolve their effect after the moat is revealed
     * but before the opposing player resolves their effect
     *
     * @var bool
     */
    public $moatRevealed = false;

}