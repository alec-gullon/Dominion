<?php

namespace App\Models\Game\Cards;

class Village extends Card {

    protected $value = 3;

    protected $stub = 'village';

    protected $name = 'Village';

    protected $types = array(
        'action'
    );

    protected $steps = array(
        'play'
    );

}