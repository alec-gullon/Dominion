<?php

namespace App\Game\Models\Cards;

class Chancellor extends Card {

    protected $value = 3;

    protected $stub = 'chancellor';

    protected $name = 'Chancellor';

    protected $types = array(
        'action'
    );

    protected $steps = array(
        'play',
        'put-deck-in-discard'
    );

}