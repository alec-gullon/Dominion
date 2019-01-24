<?php

namespace App\Game\Models\Cards;

class Spy extends Card {

    protected $value = 3;

    protected $stub = 'spy';

    protected $name = 'Spy';

    public $moatRevealed = false;

    protected $types = array(
        'action', 'attack'
    );

    protected $steps = array(
        'play',
        'resolve-moat',
        'resolve-attack'
    );

}