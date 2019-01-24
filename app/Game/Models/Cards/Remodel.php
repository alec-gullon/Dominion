<?php

namespace App\Game\Models\Cards;

class Remodel extends Card {

    protected $value = 4;

    protected $stub = 'remodel';

    protected $name = 'Remodel';

    protected $types = ['action'];

    protected $steps = [
        'play',
        'trash-card',
        'gain-selected-card'
    ];

    public $gainValue = 0;

}