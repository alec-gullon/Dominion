<?php

namespace App\Models\Game\Cards;

class Feast extends Card {

    protected $value = 4;

    protected $stub = 'feast';

    protected $name = 'Feast';

    protected $type = array(
        'action'
    );

    protected $steps = array(
        'play',
        'gain-selected-card'
    );

}