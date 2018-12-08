<?php

namespace App\Models\Game\Cards;

class Silver extends Card {

    protected $value = 3;

    protected $types = array(
        'treasure'
    );

    protected $stub = 'silver';

    protected $name = 'Silver';

    protected $denomination = 2;

}