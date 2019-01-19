<?php

namespace App\Models\Game\Cards;

class Workshop extends Card {

    protected $value = 3;

    protected $stub = 'workshop';

    protected $name = 'Workshop';

    protected $types = ['action'];

    protected $steps = array(
        'play',
        'gain-selected-card'
    );

}