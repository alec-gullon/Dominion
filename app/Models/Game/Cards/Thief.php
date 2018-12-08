<?php

namespace App\Models\Game\Cards;

class Thief extends Card {

    protected $value = 3;

    protected $stub = 'thief';

    protected $name = 'Thief';

    protected $types = array(
        'action', 'attack'
    );

    protected $steps = array(
        'play',
        'resolve-moat',
        'resolve-attack'
    );

}