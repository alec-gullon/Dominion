<?php

namespace App\Game\Models\Cards;

class Thief extends Card {

    protected $value = 3;

    protected $stub = 'thief';

    protected $name = 'Thief';

    public $moatRevealed = false;

    protected $types = array(
        'action', 'attack'
    );

    protected $steps = array(
        'play',
        'resolve-moat',
        'resolve-attack',
        'gain-trashed-card'
    );

}