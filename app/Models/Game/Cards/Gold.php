<?php

namespace App\Models\Game\Cards;

class Gold extends Card {

    protected $value = 6;

    protected $types = [
        'treasure'
    ];

    protected $stub = 'gold';

    protected $name = 'Gold';

    protected $denomination = 3;

}