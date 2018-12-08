<?php

namespace App\Models\Game\Cards;

class Estate extends Card {

    protected $value = 2;

    protected $points = 1;

    protected $stub = 'estate';

    protected $name = 'Estate';

    protected $types = array(
        'victory'
    );

}