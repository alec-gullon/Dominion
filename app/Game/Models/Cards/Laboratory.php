<?php

namespace App\Game\Models\Cards;

class Laboratory extends Card {

    protected $value = 5;

    protected $stub = 'laboratory';

    protected $name = 'Laboratory';

    protected $types = array(
        'action'
    );

    protected $steps = array(
        'play'
    );

}