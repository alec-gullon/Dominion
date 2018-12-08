<?php

namespace App\Models\Game\Cards;

class Bureaucrat extends Card {

    protected $value = 3;

    protected $stub = 'bureaucrat';

    protected $name = 'Bureaucrat';

    protected $types = array(
        'action', 'attack'
    );

    protected $steps = array(
        'play',
        'resolve-moat',
        'resolve-attack'
    );

}