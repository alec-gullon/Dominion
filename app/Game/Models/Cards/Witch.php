<?php

namespace App\Game\Models\Cards;

class Witch extends Card {

    protected $value = 3;

    protected $stub = 'witch';

    protected $name = 'Witch';

    protected $types = array(
        'action',
        'attack'
    );

    protected $steps = array(
        'play',
        'resolve-moat',
        'resolve-attack'
    );

}