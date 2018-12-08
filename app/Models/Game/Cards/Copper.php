<?php

namespace App\Models\Game\Cards;

class Copper extends Card {

    protected $value = 0;

    protected $types = array(
        'treasure'
    );

    protected $stub = 'copper';

    protected $name = 'Copper';

    protected $denomination = 1;

}