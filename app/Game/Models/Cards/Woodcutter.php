<?php

namespace App\Game\Models\Cards;

class Woodcutter extends Card {

    protected $value = 3;

    protected $stub = 'woodcutter';

    protected $name = 'Woodcutter';

    protected $type = array(
        'action'
    );

    protected $steps = array(
        'play'
    );

}