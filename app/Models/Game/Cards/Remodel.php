<?php

namespace App\Models\Game\Cards;

class Remodel extends Card {

    protected $value = 4;

    protected $stub = 'remodel';

    protected $name = 'Remodel';

    protected $type = 'action';

    protected $steps = array(
        'play',
        'trash-card',
        'gain-selected-card'
    );

    public $gainValue = 0;

}