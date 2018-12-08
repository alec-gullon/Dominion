<?php

namespace App\Models\Game\Cards;

class Moat extends Card {

    protected $value = 2;

    protected $stub = 'moat';

    protected $name = 'Moat';

    protected $type = array(
        'action',
        'reaction'
    );

    protected $steps = array(
        'play'
    );

}