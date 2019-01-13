<?php

namespace App\Models\Game\Cards;

class Province extends Card {

    protected $value = 8;

    protected $points = 6;

    protected $types = [
        'victory'
    ];

    protected $stub = 'province';

    protected $name = 'Province';

}