<?php

namespace App\Game\Models\Cards;

class Market extends Card {

    protected $value = 5;

    protected $stub = 'market';

    protected $name = 'Market';

    protected $types = array(
        'action'
    );

    protected $steps = array(
        'play'
    );

}