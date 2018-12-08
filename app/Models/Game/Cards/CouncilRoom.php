<?php

namespace App\Models\Game\Cards;

class CouncilRoom extends Card {

    protected $value = 5;

    protected $stub = 'council-room';

    protected $name = 'Council Room';

    protected $types = array(
        'action'
    );

    protected $steps = array(
        'play'
    );

}