<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Bureaucrat card from the Dominion card game
 */
class Bureaucrat extends Card {

    public $value = 3;

    public $stub = 'bureaucrat';

    public $name = 'Bureaucrat';

    public $types = [
        'action',
        'attack'
    ];

    public $features = [
        'terminal'
    ];

}