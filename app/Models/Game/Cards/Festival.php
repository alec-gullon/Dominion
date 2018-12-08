<?php

namespace App\Models\Game\Cards;

class Festival extends Card {

    protected $value = 5;

    protected $stub = 'festival';

    protected $name = 'Festival';

    protected $types = array(
        'action'
    );

    protected $steps = array(
        'play'
    );

}