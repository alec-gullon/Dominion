<?php

namespace App\Models\Game\Cards;

class Duchy extends Card {

    protected $value = 5;

    protected $points = 3;

    protected $types = [
        'victory'
    ];

    protected $stub = 'duchy';

    protected $name = 'Duchy';

}