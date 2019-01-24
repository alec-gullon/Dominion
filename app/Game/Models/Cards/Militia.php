<?php

namespace App\Game\Models\Cards;

class Militia extends Card {

    protected $value = 3;

    protected $stub = 'militia';

    protected $name = 'Militia';

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