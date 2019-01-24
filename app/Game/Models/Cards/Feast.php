<?php

namespace App\Game\Models\Cards;

class Feast extends Card {

    protected $value = 4;

    protected $stub = 'feast';

    protected $name = 'Feast';

    protected $types = array(
        'action'
    );

    protected $steps = array(
        'play',
        'gain-selected-card'
    );

}