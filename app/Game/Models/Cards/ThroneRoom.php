<?php

namespace App\Game\Models\Cards;

class ThroneRoom extends Card {

    protected $value = 3;

    protected $stub = 'throne-room';

    protected $name = 'Throne Room';

    protected $types = array(
        'action'
    );

    protected $steps = array(
        'play',
        'duplicate-card'
    );

}