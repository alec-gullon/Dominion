<?php

namespace App\Models\Game\Cards;

class Adventurer extends Card {

    protected $value = 6;

    protected $stub = 'adventurer';

    protected $name = 'Adventurer';

    protected $types = array(
        'action'
    );

    protected $steps = array(
        'play'
    );

}