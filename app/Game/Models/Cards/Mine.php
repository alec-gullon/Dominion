<?php

namespace App\Game\Models\Cards;

class Mine extends Card {

    protected $value = 5;

    protected $stub = 'mine';

    protected $name = 'Mine';

    protected $types = array(
        'action'
    );

    protected $steps = array(
        'play',
        'trash-treasure',
        'gain-treasure'
    );

    public $treasureValue = 0;

}